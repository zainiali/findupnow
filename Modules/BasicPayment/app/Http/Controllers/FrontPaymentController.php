<?php

namespace Modules\BasicPayment\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\GetGlobalInformationTrait;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\BasicPayment\app\Enums\BasicPaymentSupportedCurrencyListEnum;
use Modules\BasicPayment\app\Http\Requests\BankInformationRequest;
use Modules\BasicPayment\app\Interfaces\PaymentActions;
use Modules\BasicPayment\app\Traits\PaymentTrait;
use Modules\Subscription\Entities\PurchaseHistory;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;

class FrontPaymentController extends Controller implements PaymentActions
{
    use GetGlobalInformationTrait, PaymentTrait;

    /**
     * @var mixed
     */
    private $basicPayment = null;

    public function __construct()
    {
        $settings = Cache::has('setting') ? Cache::get('setting') : null;
        if ($settings) {
            $this->appName = $settings->app_name;
        }
        $this->basicPayment = $this->getBasicPaymentInfo();
    }

    /**
     * @return mixed
     */
    public function processPayment($order, $orderType = 'order')
    {
        if ($orderType == 'order') {
            $this->checkUnpaidStatus($order);
        }
    }

    /**
     * @param Request $request
     */
    public function payWithStripe(Request $request)
    {
        Stripe::setApiKey($this->basicPayment->stripe_secret);

        if (!$request->filled('stripeToken')) {
            $notification = __(self::$messages['failed']);
            $notification = ['message' => $notification, 'alert-type' => 'error'];

            return redirect()->back()->with($notification);
        }

        $rules = [
            'card_number' => 'required|numeric',
            'year'        => 'required|numeric|min:2',
            'month'       => 'required|numeric|min:2',
            'cvc'         => 'required|numeric',
            'zip_code'    => 'required|string|max:20',
            'order_uuid'  => 'required',
            'type'        => 'required|in:order,subscription',
        ];

        $customMessages = [
            'card_number.required' => __('Card number is required'),
            'year.required'        => __('Year is required'),
            'month.required'       => __('Month is required'),
            'cvc.required'         => __('Cvc is required'),
            'zip_code.required'    => __('Zip code is required'),
            'order_uuid.required'  => __('Order details is required'),
            'type.required'        => __('Payment type not found!'),
            'type.in'              => __('Unknown Payment type!'),
        ];

        $request->validate($rules, $customMessages);

        $payable_with_charge = 0;

        if ($request->filled('token')) {
            $successUrl = route('payment-api.webview-success-payment', ['token' => $request->token]);
        } elseif ($request->type == 'order') {
            $successUrl = route('dashboard', ['id' => $request->order_uuid]);
        } elseif ($request->type == 'subscription') {
            $successUrl = route('provider.purchase-history-show', $request->order_uuid);
        }

        $after_success_url = $successUrl;

        if ($request->type == 'order') {
            $order    = Order::findOrFail($request->order_uuid);
            $currency = $order->payable_currency ?? 'usd';
        } elseif ($request->type == 'subscription') {
            $order    = PurchaseHistory::findOrFail($request->order_uuid);
            $currency = $order->payable_currency ?? 'usd';
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($request->type, $order);

        $payableAmount = $order->payable_amount;

        $allCurrencyCodes = BasicPaymentSupportedCurrencyListEnum::getStripeSupportedCurrencies();

        if (in_array(Str::upper($currency), $allCurrencyCodes['non_zero_currency_codes'])) {
            $payable_with_charge = $payableAmount;
        } elseif (in_array(Str::upper($currency), $allCurrencyCodes['three_digit_currency_codes'])) {
            $convertedCharge     = (string) $payableAmount . '0';
            $payable_with_charge = (int) $convertedCharge;
        } else {
            $payable_with_charge = (int) ($payableAmount * 100);
        }

        $this->checkUnpaidStatus($order);

        $paymentDetails = null;
        try {
            $result = Charge::create([
                'currency'    => $currency,
                'amount'      => $payable_with_charge,
                'description' => $this->appName,
                'source'      => $request->stripeToken,
            ]);

            $paymentDetails = [
                'transaction_id'   => $result->balance_transaction,
                'amount'           => $result->amount,
                'currency'         => $result->currency,
                'paid'             => $result->paid,
                'description'      => $result->description,
                'seller_message'   => $result->outcome->seller_message,
                'payment_method'   => $result->payment_method,
                'card_last4_digit' => $result->payment_method_details->card->last4,
                'card_brand'       => $result->payment_method_details->card->brand . ' - ' . $result->payment_method_details->card->country,
                'receipt_url'      => $result->receipt_url,
                'status'           => $result->status,
                'zip_code'         => $request->zip_code ?? null,
            ];

            $paid_amount  = $result->amount;
            $paidCurrency = Str::upper($currency);

            if (in_array($paidCurrency, $allCurrencyCodes['three_digit_currency_codes'])) {
                $paid_amount = round($paid_amount / 10, 2);
            } elseif (!in_array($paidCurrency, $allCurrencyCodes['non_zero_currency_codes'])) {
                $paid_amount = round($paid_amount / 100, 2);
            }
            $this->saveOrderSuccess($order, $paymentDetails, $paid_amount, $result->currency, $result->balance_transaction, $request->type);
        } catch (\Exception $e) {
            info($e);
            $notification = __(self::$messages['failed']);
            $notification = ['message' => $notification, 'alert-type' => 'error'];

            return redirect()->back()->with($notification);
        }
        $this->afterSuccessOperations();
        $notification = __(self::$messages['success']);
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect($after_success_url)->with($notification);
    }

    /**
     * @param $id
     * @param $type
     */
    public function payWithPaypal($id, $type = null)
    {
        $returnUrl = route('pay.paypal-success', ['uuid' => $id, 'type' => $type]);

        if (request()->filled('token')) {
            $after_success_url = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $returnUrl         = route('payment-api.paypal-success', ['token' => request()->token, 'type' => $type, 'uuid' => $id]);
            $after_failed_url  = route('payment-api.webview-failed-payment');
        } elseif ($type == 'order') {
            $after_success_url = route('dashboard', ['id' => $id]);
            $after_failed_url  = $after_success_url;
        } elseif ($type == 'subscription') {
            $after_success_url = route('provider.purchase-history-show', $id);
            $after_failed_url  = $after_success_url;
        }

        if ($type == 'order') {
            $order = Order::findOrFail($id);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);

        $currency = $order->payable_currency;

        $basic_payment = $this->getBasicPaymentInfo();

        $paypal_credentials = (object) [
            'paypal_client_id'    => $basic_payment->paypal_client_id,
            'paypal_secret_key'   => $basic_payment->paypal_secret_key,
            'paypal_account_mode' => $basic_payment->paypal_account_mode,
            'paypal_app_id'       => $basic_payment->paypal_app_id,
        ];

        config(['paypal.mode' => $paypal_credentials->paypal_account_mode]);

        if ($paypal_credentials->paypal_account_mode == 'sandbox') {
            config(['paypal.sandbox.client_id' => $paypal_credentials->paypal_client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_credentials->paypal_secret_key]);
        } else {
            config(['paypal.live.client_id' => $paypal_credentials->paypal_client_id]);
            config(['paypal.live.client_secret' => $paypal_credentials->paypal_secret_key]);
        }

        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $appId = isset($paypalToken['app_id']) ? $paypalToken['app_id'] : '';

            if ($appId) {
                config(['paypal.live.app_id' => $appId]);
                session()->put('paypal_app_id', $appId);
            }

            $response = $provider->createOrder([
                'intent'              => 'CAPTURE',
                'application_context' => [
                    'return_url' => $returnUrl,
                    'cancel_url' => $after_failed_url,
                ],
                'purchase_units'      => [
                    0 => [
                        'amount' => [
                            'currency_code' => $currency,
                            'value'         => $order->payable_amount,
                        ],
                    ],
                ],
            ]);
        } catch (Exception $ex) {
            $notification = $ex->getMessage();
            logger($notification);
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            throw new HttpResponseException(redirect()->back()->with($notification));
        }

        if (isset($response['id']) && $response['id'] != null) {
            Session::put('after_success_url', $after_success_url);
            Session::put('after_failed_url', $after_failed_url);
            Session::put('order_uuid', $order->id);
            Session::put('order_type', $type);
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            $notification = __(self::$messages['failed']);
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            throw new HttpResponseException(redirect()->back()->with($notification));
        } else {
            $notification = __(self::$messages['failed']);
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            throw new HttpResponseException(redirect()->back()->with($notification));
        }
    }

    /**
     * @param Request $request
     */
    public function paypalSuccess(Request $request)
    {
        $orderId   = $request->has('uuid') ? $request->uuid : Session::get('order_uuid');
        $orderType = $request->has('type') ? $request->type : Session::get('order_type');

        Session::forget('order_type');

        if ($orderType == 'order') {
            $order = Order::findOrFail($orderId);
        } elseif ($orderType == 'subscription') {
            $order = PurchaseHistory::findOrFail($orderId);
        }

        $this->putProviderSession($orderType, $order);

        $this->checkUnpaidStatus($order);

        $basic_payment = $this->getBasicPaymentInfo();

        $paypal_credentials = (object) [
            'paypal_client_id'    => $basic_payment->paypal_client_id,
            'paypal_secret_key'   => $basic_payment->paypal_secret_key,
            'paypal_account_mode' => $basic_payment->paypal_account_mode,
            'paypal_app_id'       => $basic_payment->paypal_app_id,
        ];

        if ($paypal_credentials->paypal_account_mode == 'sandbox') {
            config(['paypal.sandbox.client_id' => $paypal_credentials->paypal_client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_credentials->paypal_secret_key]);
        } else {
            config(['paypal.live.client_id' => $paypal_credentials->paypal_client_id]);
            config(['paypal.live.client_secret' => $paypal_credentials->paypal_secret_key]);
            if (session()->has('paypal_app_id')) {
                config(['paypal.live.app_id' => session()->get('paypal_app_id')]);
            }
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $after_success_url = Session::get('after_success_url');

            $paid_amount = data_get($response, 'purchase_units.0.payments.captures.0.amount.value');

            $paymentDetails = [
                'payments_captures_id' => data_get($response, 'purchase_units.0.payments.captures.0.id'),
                'amount'               => data_get($response, 'purchase_units.0.payments.captures.0.amount.value'),
                'currency'             => data_get($response, 'purchase_units.0.payments.captures.0.amount.currency_code'),
                'paid'                 => data_get($response, 'purchase_units.0.payments.captures.0.seller_receivable_breakdown.gross_amount.value'),
                'paypal_fee'           => data_get($response, 'purchase_units.0.payments.captures.0.seller_receivable_breakdown.paypal_fee.value'),
                'net_amount'           => data_get($response, 'purchase_units.0.payments.captures.0.seller_receivable_breakdown.net_amount.value'),
                'status'               => data_get($response, 'purchase_units.0.payments.captures.0.status'),
            ];

            $this->saveOrderSuccess(
                $order,
                $paymentDetails,
                $paid_amount,
                data_get($response, 'purchase_units.0.payments.captures.0.amount.currency_code'),
                $request->PayerID,
                $orderType
            );

            $this->afterSuccessOperations();

            return redirect($after_success_url)->with([
                'alert-type' => 'success',
                'message'    => __(self::$messages['success']),
            ]);
        } else {
            $after_failed_url = Session::get('after_failed_url');

            return redirect($after_failed_url)->with([
                'alert-type' => 'error',
                'message'    => __(self::$messages['failed']),
            ]);
        }
    }

    /**
     * @param BankInformationRequest $request
     */
    public function payWithBank(BankInformationRequest $request)
    {
        if ($request->order_type == 'order') {
            $order = Order::findOrFail($request->order_uuid);
            $route = route('dashboard', ['id' => $order->id]);
        } elseif ($request->order_type == 'subscription') {
            $order = PurchaseHistory::findOrFail($request->order_uuid);
            $route = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        if (request()->filled('token')) {
            $route = route('payment-api.webview-success-payment', ['token' => request()->token]);
        }

        $this->checkUnpaidStatus($order);

        try {
            $bankDetails = json_encode($request->only(['bank_name', 'account_number', 'routing_number', 'branch', 'transaction']));

            if ($this->checkTransactionExists($request)) {
                return back()->with([
                    'alert-type' => 'error',
                    'message'    => __('Payment failed, transaction already exist'),
                ]);
            }

            $order->transection_id  = 'bank_' . rand(100000, 999999) . '_' . now()->timestamp;
            $order->payment_details = $bankDetails;
            $order->payment_status  = 'success';
            $order->save();

            $this->afterSuccessOperations();

            return redirect($route)->with([
                'alert-type' => 'success',
                'message'    => __(self::$messages['success']),
            ]);
        } catch (Exception $e) {
            logger($e);

            return back()->with([
                'alert-type' => 'error',
                'message'    => __(self::$messages['failed']),
            ]);
        }
    }

    /**
     * @param $request
     */
    public function checkTransactionExists($request): bool
    {
        $allPayments = Order::whereNotNull('payment_details')->get();

        foreach ($allPayments as $payment) {
            $paymentDetailsJson = json_decode($payment->payment_details, true);

            $accountNumber = data_get($paymentDetailsJson, 'account_number');
            $transaction   = data_get($paymentDetailsJson, 'transaction');

            if ($accountNumber === $request->account_number && $transaction === $request->transaction) {
                return true;
            }
        }

        return false;
    }
}
