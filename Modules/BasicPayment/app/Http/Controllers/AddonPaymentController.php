<?php

namespace Modules\BasicPayment\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\GetGlobalInformationTrait;
use CoinGate\Client as CoinGateClient;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Instamojo\Instamojo;
use JsonException;
use Modules\BasicPayment\app\Library\SslCommerz\SslCommerzNotification;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\BasicPayment\app\Traits\PaymentTrait;
use Modules\Subscription\Entities\PurchaseHistory;
use Mollie\Laravel\Facades\Mollie;
use Razorpay\Api\Api as RazorPayApi;

class AddonPaymentController extends Controller
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
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function payWithRazorpay(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order             = Order::findOrFail($uuid);
            $after_success_url = route('dashboard', ['id' => $order->id]);
        } elseif ($type == 'subscription') {
            $order             = PurchaseHistory::findOrFail($uuid);
            $after_success_url = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);

        $after_failed_url = $after_success_url;

        if (request()->filled('token')) {
            $after_success_url = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $after_failed_url  = route('payment-api.webview-failed-payment');
        }

        $payment_setting      = $this->getPaymentGatewayInfo();
        $razorpay_credentials = (object) [
            'razorpay_key'    => $payment_setting->razorpay_key,
            'razorpay_secret' => $payment_setting->razorpay_secret,
        ];
        $input   = $request->all();
        $api     = new RazorPayApi($razorpay_credentials->razorpay_key, $razorpay_credentials->razorpay_secret);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response       = $api->payment->fetch($input['razorpay_payment_id'])->capture(['amount' => $payment['amount']]);
                $paymentDetails = [
                    'transaction_id' => $response->id,
                    'amount'         => $response->amount,
                    'currency'       => $response->currency,
                    'fee'            => $response->fee,
                    'description'    => $response->description,
                    'payment_method' => $response->method,
                    'status'         => $response->status,
                ];
                $this->saveOrderSuccess($order, $paymentDetails, $response->amount, $response->currency, $response->id, $type);

                $this->afterSuccessOperations();

                return redirect($after_success_url)->with([
                    'alert-type' => 'success',
                    'message'    => __(self::$messages['success']),
                ]);
            } catch (\Exception $e) {
                info($e);

                return redirect($after_failed_url)->with([
                    'alert-type' => 'error',
                    'message'    => __(self::$messages['failed']),
                ]);
            }
        } else {
            return redirect($after_failed_url)->with([
                'alert-type' => 'error',
                'message'    => __(self::$messages['failed']),
            ]);
        }
    }

    /**
     * @param $uuid
     * @param $type
     */
    public function payWithMollie(Request $request, $uuid, $type)
    {
        $redirectUrl = route('pay.mollie-success', ['uuid' => $uuid, 'type' => $type]);

        if (request()->filled('token')) {
            $redirectUrl       = route('payment-api.mollie-success', ['uuid' => $uuid, 'type' => $type, 'token' => request()->token]);
            $after_success_url = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $after_failed_url  = route('payment-api.webview-failed-payment');
        } elseif ($type == 'order') {
            $after_success_url = route('dashboard', ['id' => $uuid]);
            $after_failed_url  = $after_success_url;
        } elseif ($type == 'subscription') {
            $after_success_url = route('provider.purchase-history-show', $uuid);
            $after_failed_url  = $after_success_url;
        }

        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);

        $payment_setting          = $this->getPaymentGatewayInfo();
        $calculate_payable_charge = $order->payable_amount;
        $currency                 = $order->payable_currency;
        $currency                 = strtoupper($currency);
        try {
            Mollie::api()->setApiKey($payment_setting->mollie_key);
            $payment = Mollie::api()
                ->payments()
                ->create([
                    'amount'      => [
                        'currency' => '' . $currency . '',
                        'value'    => '' . $calculate_payable_charge . '',
                    ],
                    'description' => "A payment from {$this->appName}",
                    'redirectUrl' => $redirectUrl,
                ]);
            $payment = Mollie::api()->payments()->get($payment->id);

            session()->put('payment_id', $payment->id);
            session()->put('after_success_url', $after_success_url);
            session()->put('after_failed_url', $after_failed_url);

            return redirect($payment->getCheckoutUrl(), 303);
        } catch (Exception $ex) {
            logger($ex);
            $notification = $ex->getMessage();
            $notification = ['message' => $notification, 'alert-type' => 'error'];

            return back()->with($notification);
        }
    }

    /**
     * @param $uuid
     * @param $type
     */
    public function mollieSuccess(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $after_success_url = Session::get('after_success_url');
        $after_failed_url  = Session::get('after_failed_url');

        $payment_setting = $this->getPaymentGatewayInfo();

        Mollie::api()->setApiKey($payment_setting->mollie_key);

        $payment = Mollie::api()->payments->get(session()->get('payment_id'));

        if ($payment->isPaid()) {
            $paymentDetails = [
                'transaction_id' => $payment->id,
                'amount'         => $payment?->amount?->value,
                'currency'       => $payment?->amount?->currency,
                'fee'            => $payment?->settlementAmount?->value . ' ' . $payment?->settlementAmount?->currency,
                'description'    => $payment?->description,
                'payment_method' => $payment?->method,
                'status'         => $payment?->status,
                'paid_at'        => $payment?->paidAt,
            ];

            $this->saveOrderSuccess($order, $paymentDetails, $payment->amount->value, $payment->amount->currency, $payment->id, $type);

            $this->afterSuccessOperations();

            return redirect($after_success_url)->with([
                'alert-type' => 'success',
                'message'    => __(self::$messages['success']),
            ]);
        } else {
            return redirect($after_failed_url)->with([
                'alert-type' => 'error',
                'message'    => __(self::$messages['failed']),
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function payWithPaystack(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new JsonException(__(self::$messages['paymentTypeNotFound']), 403);
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);
        $reference   = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key  = $this->getPaymentGatewayInfo()->paystack_secret_key;
        $response    = Http::withToken($secret_key)
            ->withHeaders(['Cache-Control' => 'no-cache'])
            ->get("https://api.paystack.co/transaction/verify/{$reference}");
        if ($response->failed()) {
            info($response->body());

            return response()->json(['message' => __(self::$messages['error'])], 403);
        }
        $final_data = $response->json();
        if ($final_data['status']) {
            $paymentDetails = [
                'status'             => $this->checkArrayIsset($final_data['data']['status']),
                'transaction_id'     => $transaction,
                'requested_amount'   => $this->checkArrayIsset($final_data['data']['requested_amount']),
                'amount'             => $this->checkArrayIsset($final_data['data']['amount']),
                'currency'           => $this->checkArrayIsset($final_data['data']['currency']),
                'gateway_response'   => $this->checkArrayIsset($final_data['data']['gateway_response']),
                'paid_at'            => $this->checkArrayIsset($final_data['data']['paid_at']),
                'card_last_4_digits' => $this->checkArrayIsset($final_data['data']['authorization']['last4']),
            ];

            $this->saveOrderSuccess($order, $paymentDetails, $this->checkArrayIsset($final_data['data']['amount']), $this->checkArrayIsset($final_data['data']['currency']), $transaction, $type);

            $this->afterSuccessOperations();

            session()->flash('success', __(self::$messages['success']));

            return response()->json(['message' => __(self::$messages['success'])]);
        } else {
            return response()->json(['message' => __(self::$messages['error'])], 403);
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function payWithFlutterwave(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new JsonException(__(self::$messages['paymentTypeNotFound']), 403);
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);

        $tnx_id     = $request->tnx_id;
        $secret_key = $this->getPaymentGatewayInfo()->flutterwave_secret_key;
        $url        = "https://api.flutterwave.com/v3/transactions/{$tnx_id}/verify";
        $response   = Http::withToken($secret_key)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->get($url);
        $responseData = $response->json();
        if ($response->successful() && $responseData['status'] === 'success') {
            $paymentDetails = [
                'status'            => $this->checkArrayIsset($responseData['status']),
                'trx_id'            => $tnx_id,
                'amount'            => $this->checkArrayIsset($responseData['data']['amount']),
                'amount_settled'    => $this->checkArrayIsset($responseData['data']['amount_settled']),
                'currency'          => $this->checkArrayIsset($responseData['data']['currency']),
                'charged_amount'    => $this->checkArrayIsset($responseData['data']['charged_amount']),
                'app_fee'           => $this->checkArrayIsset($responseData['data']['app_fee']),
                'merchant_fee'      => $this->checkArrayIsset($responseData['data']['merchant_fee']),
                'card_last_4digits' => $this->checkArrayIsset($responseData['data']['card']['last_4digits']),
            ];
            $this->saveOrderSuccess($order, $paymentDetails, $this->checkArrayIsset($responseData['data']['amount']), $this->checkArrayIsset($responseData['data']['currency']), $tnx_id, $type);
            $this->afterSuccessOperations();

            session()->flash('success', __(self::$messages['success']));

            return response()->json(['message' => __(self::$messages['success'])]);
        } else {
            return response()->json(['message' => __(self::$messages['error'])], 403);
        }
    }

    public function initInstamojo()
    {
        try {
            $environment   = $this->getPaymentGatewayInfo()->instamojo_account_mode;
            $client_id     = $this->getPaymentGatewayInfo()->instamojo_client_id;
            $client_secret = $this->getPaymentGatewayInfo()->instamojo_client_secret;
            $test          = str($environment)->lower() == str('Sandbox')->lower() ? true : false;

            return Instamojo::init(
                type: 'app',
                params: [
                    'client_id'     => $client_id,
                    'client_secret' => $client_secret,
                ],
                test: $test,
            );
        } catch (Exception $e) {
            PaymentMethodService::removeSessions();
            logger($e->getMessage());
            throw new HttpResponseException(back()->with('error', $e->getMessage()));
        }
    }

    /**
     * @param $uuid
     * @param $type
     */
    public function payWithInstamojo(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $this->checkUnpaidStatus($order);

        $redirectUrl = route('pay.instamojo-success', ['uuid' => $uuid, 'type' => $type]);

        if (request()->filled('token')) {
            $redirectUrl = route('payment-api.instamojo-success', ['token' => request()->token, 'uuid' => $uuid, 'type' => $type]);
        }

        try {
            $api = $this->initInstamojo();

            $response = $api->createPaymentRequest([
                'purpose'      => 'Payment for ' . $this->appName,
                'amount'       => $order->payable_amount,
                'send_email'   => true,
                'email'        => Auth::user()->email ?? '',
                'redirect_url' => $redirectUrl,
            ]);

            return isset($response['longurl']) ? redirect($response['longurl']) : redirect()->back()->with('error', __('Redirect url not found'));
        } catch (Exception $ex) {
            PaymentMethodService::removeSessions();

            return redirect()->back()->with(['message' => $ex->getMessage(), 'alert-type' => 'error']);
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function instamojoSuccess(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
            $route = route('dashboard', ['id' => $order->id]);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
            $route = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $failedRoute = $route;

        if (request()->filled('token')) {
            $route       = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $failedRoute = route('payment-api.webview-failed-payment', ['token' => request()->token]);
        }

        $api = $this->initInstamojo();
        try {
            $response     = $api->getPaymentDetails($request->get('payment_id'));
            $responseData = json_decode(json_encode($response), true);
            if ($responseData['status'] === true) {
                $paymentDetails = [
                    'status'             => $this->checkArrayIsset($responseData['status']),
                    'trx_id'             => $this->checkArrayIsset($responseData['id']),
                    'amount'             => $this->checkArrayIsset($responseData['amount']),
                    'currency'           => $this->checkArrayIsset($responseData['currency']),
                    'fees'               => $this->checkArrayIsset($responseData['fees']),
                    'total_taxes'        => $this->checkArrayIsset($responseData['total_taxes']),
                    'instrument_type'    => $this->checkArrayIsset($responseData['instrument_type']),
                    'billing_instrument' => $this->checkArrayIsset($responseData['billing_instrument']),
                    'created_at'         => $this->checkArrayIsset($responseData['created_at']),
                    'updated_at'         => $this->checkArrayIsset($responseData['updated_at']),
                ];

                $this->saveOrderSuccess($order, $paymentDetails, $this->checkArrayIsset($responseData['amount']), $this->checkArrayIsset($responseData['currency']), $this->checkArrayIsset($responseData['id']), $type);

                $this->afterSuccessOperations();

                $notification = [
                    'alert-type' => 'success',
                    'message'    => __('Payment success'),
                ];

                return redirect($route)->with($notification);
            } else {
                return redirect($failedRoute)->with('error', __('Payment failed'));
            }
        } catch (Exception $e) {
            PaymentMethodService::removeSessions();
            logger($e->getMessage());

            return redirect($failedRoute)->with('error', __('Payment failed'));
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function payWithSslcommerz(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        if (request()->filled('token')) {
            $route = route('payment-api.sslcommerz-success', ['uuid' => $uuid, 'type' => $type, 'token' => request()->token]);
        } else {
            $route = route('pay.sslcommerz-success', ['uuid' => $uuid, 'type' => $type]);
        }

        $failedRoute = $route;

        $order_data = [
            'total_amount'     => $order->payable_amount,
            'currency'         => 'BDT',
            'tran_id'          => uniqid(),
            // CUSTOMER INFORMATION
            'cus_name'         => $order->client->name ?? 'Customer Name',
            'cus_email'        => $order->client->email ?? 'example@gmail.com',
            'cus_add1'         => $order->client->address ?? 'Dhaka',
            'cus_add2'         => 'Dhaka',
            'cus_city'         => '',
            'cus_state'        => '',
            'cus_postcode'     => '',
            'cus_country'      => 'Bangladesh',
            'cus_phone'        => '8801XXXXXXXXX',
            'cus_fax'          => '',
            // SHIPMENT INFORMATION
            'ship_name'        => $this->appName,
            'ship_add1'        => 'Dhaka',
            'ship_add2'        => 'Dhaka',
            'ship_city'        => 'Dhaka',
            'ship_state'       => 'Dhaka',
            'ship_postcode'    => '1000',
            'ship_phone'       => '',
            'ship_country'     => 'Bangladesh',
            'shipping_method'  => 'NO',
            'product_name'     => 'Computer',
            'product_category' => 'Goods',
            'product_profile'  => 'physical-goods',
            // OPTIONAL PARAMETERS
            'value_a'          => $type,
            'value_b'          => $uuid,
        ];

        if (request()->filled('token')) {
            $order_data['value_c'] = request()->token;
        }

        $environment = $this->getPaymentGatewayInfo()->sslcommerz_test_mode;
        $storeId     = $this->getPaymentGatewayInfo()->sslcommerz_store_id;
        $storePass   = $this->getPaymentGatewayInfo()->sslcommerz_store_password;
        $isLocalhost = $this->getPaymentGatewayInfo()->sslcommerz_localhost;

        if ($environment == 1) {
            $apiDomain = 'https://sandbox.sslcommerz.com';
        } else {
            $apiDomain = 'https://securepay.sslcommerz.com';
        }

        config(['sslcommerz.apiDomain' => $apiDomain]);
        config(['sslcommerz.connect_from_localhost' => $isLocalhost]);
        config(['sslcommerz.apiCredentials.store_id' => $storeId]);
        config(['sslcommerz.apiCredentials.store_password' => $storePass]);
        config(['sslcommerz.success_url' => $route]);
        config(['sslcommerz.failed_url' => $failedRoute]);

        $payment_options = (new SslCommerzNotification())->makePayment($order_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = [];
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function sslcommerzSuccess(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
            $route = route('dashboard', ['id' => $order->id]);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
            $route = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $failedRoute = $route;

        if (request()->filled('token')) {
            $route       = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $failedRoute = route('payment-api.webview-failed-payment', ['token' => request()->token]);
        }

        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');
        $status   = $request->input('status');

        $validation = (new SslCommerzNotification())->orderValidate($request->all(), $tran_id, $amount, $currency);

        if ($validation && strtolower($status) == 'valid') {
            $details = [
                'status'        => $status,
                'trx_id'        => $tran_id,
                'amount'        => $amount,
                'currency'      => $currency,
                'currency_rate' => $request->input('currency_rate'),
                'store_amount'  => $request->input('store_amount'),
                'card_type'     => $request->input('card_type'),
                'bank_tran_id'  => $request->input('bank_tran_id'),
                'val_id'        => $request->input('val_id'),
                'tran_date'     => $request->input('tran_date'),
            ];

            $this->saveOrderSuccess($order, $details, $amount, $currency, $tran_id, $type);

            $this->afterSuccessOperations();

            $notification = [
                'alert-type' => 'success',
                'message'    => __('Payment success'),
            ];

            return redirect($route)->with($notification);
        } else {
            return redirect($failedRoute)->with([
                'message'    => __('Payment failed'),
                'alert-type' => 'error',
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function createCryptoPayment(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order       = Order::findOrFail($uuid);
            $failedRoute = route('dashboard', ['id' => $order->id]);
        } elseif ($type == 'subscription') {
            $order       = PurchaseHistory::findOrFail($uuid);
            $failedRoute = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        if (request()->filled('token')) {
            $failedRoute = route('payment-api.webview-failed-payment', ['token' => request()->token]);
        }

        try {
            $client = $this->createCoinGateClient();
        } catch (Exception $e) {
            return to_route($failedRoute)->with([
                'message'    => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }

        $cToken = hash('sha512', 'coingate' . rand());

        if (request()->filled('token')) {
            $callbackUrl = route('payment-api.coin-gate-success', [
                'token'   => request()->token,
                'uuid'    => $uuid,
                'type'    => $type,
                'c_token' => $cToken,
            ]);

            $successUrl = route('pay.coin-gate-success',
                [
                    'uuid'  => $uuid,
                    'type'  => $type,
                    'token' => request()->token,
                ]);
        } else {
            $callbackUrl = route('pay.coin-gate-callback', [
                'c_token' => $cToken,
            ]);
            $successUrl = route('pay.coin-gate-success',
                [
                    'uuid' => $uuid,
                    'type' => $type,
                ]);
        }

        try {
            $params = [
                'order_id'         => $order->id,
                'price_amount'     => $order->payable_amount,
                'price_currency'   => $order->payable_currency,
                'receive_currency' => $this->getPaymentGatewayInfo()->crypto_receive_currency ?? 'BTC',
                'callback_url'     => $callbackUrl,
                'cancel_url'       => $failedRoute,
                'success_url'      => $successUrl,
                'title'            => $this->appName . ' - Order ' . $order->id . ' Payment',
                'description'      => "Payment for order #{$order->id}",
            ];

            $order = $client->order->create($params);

            if (isset($order->payment_url)) {
                session([
                    'coin_gate_token'    => $cToken,
                    'coin_gate_order_id' => $order->id,
                ]);

                return redirect($order->payment_url);
            } else {
                return to_route($failedRoute)->with([
                    'message'    => __('Error creating CoinGate order'),
                    'alert-type' => 'error',
                ]);
            }
        } catch (Exception $e) {
            logger()->error($e->getMessage());

            return redirect($failedRoute)->with([
                'message'    => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    /**
     * @param Request    $request
     * @param $c_token
     */
    public function handleCryptoCallback(Request $request, $c_token)
    {
        $token        = $c_token;
        $sessionToken = session('coin_gate_token');
        $order_id     = session('coin_gate_order_id');

        if ($token !== $sessionToken) {
            logger()->error('Invalid token in CoinGate callback', ['received_token' => $c_token, 'expected_token' => $sessionToken]);

            return response()->json(['error' => 'Invalid token'], 400);
        }

        $client        = $this->createCoinGateClient();
        $order_details = $client->order->get($order_id);

        session()->forget(['coin_gate_token', 'coin_gate_order_id']);

        return response()->json(['status' => 'success', 'data' => $order_details]);
    }

    /**
     * @param Request $request
     * @param $uuid
     * @param $type
     */
    public function cryptoSuccess(Request $request, $uuid, $type)
    {
        if ($type == 'order') {
            $order = Order::findOrFail($uuid);
            $route = route('dashboard', ['id' => $order->id]);
        } elseif ($type == 'subscription') {
            $order = PurchaseHistory::findOrFail($uuid);
            $route = route('provider.purchase-history-show', $order->id);
        } else {
            throw new HttpResponseException(back()->with('error', __(self::$messages['paymentTypeNotFound'])));
        }

        $this->putProviderSession($type, $order);

        $failedRoute = $route;

        if (request()->filled('token')) {
            $route       = route('payment-api.webview-success-payment', ['token' => request()->token]);
            $failedRoute = route('payment-api.webview-failed-payment', ['token' => request()->token]);
        }

        $order_id = session('coin_gate_order_id');

        $order_details = [];

        if ($order_id) {
            $client = $this->createCoinGateClient();
            session()->forget(['coin_gate_token', 'coin_gate_order_id']);
            $order_details = $client->order->get($order_id);
        }

        if ($order_details && $order_details->status == 'paid') {
            $details = [
                'transaction_id'   => $order_details->uuid,
                'amount'           => $order_details->price_amount,
                'currency'         => $order_details->price_currency,
                'payment_status'   => $order_details->status,
                'pay_amount'       => $order_details->pay_amount,
                'receive_amount'   => $order_details->receive_amount,
                'receive_currency' => $order_details->receive_currency,
                'is_refundable'    => $order_details->is_refundable,
                'created'          => $order_details->paid_at,
            ];

            $this->saveOrderSuccess($order, $details, $details['amount'], $details['currency'], $details['transaction_id'], $type);

            $this->afterSuccessOperations();

            $notification = [
                'alert-type' => 'success',
                'message'    => __('Payment success'),
            ];

            return redirect($route)->with($notification);
        } else {
            return redirect($failedRoute)->with([
                'alert-type' => 'error',
                'message'    => __('Payment failed'),
            ]);
        }

    }

    private function createCoinGateClient()
    {
        $apiKey    = $this->getPaymentGatewayInfo()->crypto_api_key;
        $isSandbox = $this->getPaymentGatewayInfo()->crypto_sandbox == 1;

        return new CoinGateClient($apiKey, $isSandbox);
    }
}
