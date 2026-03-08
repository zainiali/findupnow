<?php

namespace Modules\BasicPayment\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\GetGlobalInformationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\BasicPayment\app\Enums\BasicPaymentSupportedCurrencyListEnum;
use Modules\BasicPayment\app\Http\Controllers\AddonPaymentController;
use Modules\BasicPayment\app\Http\Controllers\FrontPaymentController;
use Modules\Currency\app\Models\MultiCurrency;
use App\Models\Order;

class PaymentController extends Controller
{
    use GetGlobalInformationTrait;

    public function payment()
    {

        /**
         * you can write your project logic here, you can dyanmic payable amount also
         */
        $payable_amount = 100;

        $user = Auth::guard('web')->user();

        $basic_payment   = $this->get_basic_payment_info();
        $payment_setting = $this->get_payment_gateway_info();

        $flutterwave_currency = MultiCurrency::where('id', $payment_setting->flutterwave_currency_id)->first();
        $paystack_currency    = MultiCurrency::where('id', $payment_setting->paystack_currency_id)->first();

        /**start razorpay setting */
        $razorpay_calculate_charge = $this->calculate_payable_charge($payable_amount, 'razorpay');

        $razorpay_credentials = (object) [
            'currency_code'        => $razorpay_calculate_charge->currency_code,
            'payable_with_charge'  => $razorpay_calculate_charge->payable_with_charge,
            'razorpay_key'         => $payment_setting->razorpay_key,
            'razorpay_secret'      => $payment_setting->razorpay_secret,
            'razorpay_name'        => $payment_setting->razorpay_name,
            'razorpay_description' => $payment_setting->razorpay_description,
            'razorpay_image'       => $payment_setting->razorpay_image,
            'razorpay_theme_color' => $payment_setting->razorpay_theme_color,
            'razorpay_status'      => $payment_setting->razorpay_status,
        ];
        /**end razorpay setting */

        /**start mollie setting */
        $mollie_credentials = (object) [
            'mollie_status' => $payment_setting->mollie_status,
        ];
        /**end mollie setting */

        /**start instamojo setting */
        $instamojo_credentials = (object) [
            'instamojo_status' => $payment_setting->instamojo_status,
        ];
        /**end instamojo setting */

        /**start flutterwave setting */
        $flutterwave_calculate_charge = $this->calculate_payable_charge($payable_amount, 'flutterwave');

        $flutterwave_credentials = (object) [
            'country_code'           => $flutterwave_calculate_charge->country_code,
            'currency_code'          => $flutterwave_calculate_charge->currency_code,
            'payable_with_charge'    => $flutterwave_calculate_charge->payable_with_charge,
            'flutterwave_public_key' => $payment_setting->flutterwave_public_key,
            'flutterwave_secret_key' => $payment_setting->flutterwave_secret_key,
            'flutterwave_app_name'   => $payment_setting->flutterwave_app_name,
            'flutterwave_status'     => $payment_setting->flutterwave_status,
            'flutterwave_image'      => $payment_setting->flutterwave_image,
        ];
        /**end flutterwave setting */

        /**start paystack setting */
        $paystack_calculate_charge = $this->calculate_payable_charge($payable_amount, 'paystack');

        $paystack_credentials = (object) [
            'country_code'        => $paystack_calculate_charge->country_code,
            'currency_code'       => $paystack_calculate_charge->currency_code,
            'payable_with_charge' => $paystack_calculate_charge->payable_with_charge,
            'paystack_public_key' => $payment_setting->paystack_public_key,
            'paystack_secret_key' => $payment_setting->paystack_secret_key,
            'paystack_status'     => $payment_setting->paystack_status,
        ];
        /**end paystack setting */

        return view('payment')->with([
            'user'                    => $user,
            'payable_amount'          => $payable_amount,
            'basic_payment'           => $basic_payment,
            'payment_setting'         => $payment_setting,
            'razorpay_credentials'    => $razorpay_credentials,
            'mollie_credentials'      => $mollie_credentials,
            'instamojo_credentials'   => $instamojo_credentials,
            'flutterwave_credentials' => $flutterwave_credentials,
            'paystack_credentials'    => $paystack_credentials,
        ]);
    }

    public function stripe_pay()
    {
        $basic_payment = $this->get_basic_payment_info();

        $payable_amount = 100; /**
         * developer need to assign the amount here
         */

        // Set your Stripe API secret key
        \Stripe\Stripe::setApiKey($basic_payment->stripe_secret);

        $calculate_payable_charge = $this->calculate_payable_charge($payable_amount, 'stripe');
        $payable_with_charge      = (int) ($calculate_payable_charge->payable_with_charge * 100);

        $allCurrencyCodes = BasicPaymentSupportedCurrencyListEnum::getStripeSupportedCurrencies();

        if (in_array(Str::upper($calculate_payable_charge->currency_code), $allCurrencyCodes['non_zero_currency_codes'])) {
            $payable_with_charge = $calculate_payable_charge->payable_with_charge;
        } elseif (in_array(Str::upper($calculate_payable_charge->currency_code), $allCurrencyCodes['three_digit_currency_codes'])) {
            $convertedCharge     = (string) $calculate_payable_charge->payable_with_charge . '0';
            $payable_with_charge = (int) $convertedCharge;
        } else {
            $payable_with_charge = (int) ($calculate_payable_charge->payable_with_charge * 100);
        }

        $after_faild_url = route('payment-addon-faild');

        Session::put('payable_amount', $calculate_payable_charge->payable_amount);
        Session::put('payable_with_charge', $payable_with_charge);
        Session::put('after_faild_url', $after_faild_url);

        // Create a checkout session
        $checkoutSession = \Stripe\Checkout\Session::create([
            // 'payment_method_types' => ['bancontact','card','eps','giropay','ideal','p24','sepa_debit'], //only supported currency "eur"
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'price_data' => [
                    'currency'    => $calculate_payable_charge->currency_code,
                    'unit_amount' => $payable_with_charge, // Replace with the actual amount in cents
                    'product_data' => [
                        'name' => config('app.name'),
                    ],
                ],
                'quantity'   => 1,
            ]],
            'mode'                 => 'payment',
            'success_url'          => url('/pay-via-stripe') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => $after_faild_url,
        ]);

        // Redirect to the checkout session URL
        return redirect()->away($checkoutSession->url);
    }
    /**
     * @param Request $request
     */
    public function stripe_success(Request $request)
    {
        $after_success_url = route('payment-addon-success');

        $basic_payment = $this->get_basic_payment_info();

        // Assuming the Checkout Session ID is passed as a query parameter
        $session_id = $request->query('session_id');
        if ($session_id) {
            \Stripe\Stripe::setApiKey($basic_payment->stripe_secret);

            $session = \Stripe\Checkout\Session::retrieve($session_id);

            $paymentDetails = [
                'transaction_id' => $session->payment_intent,
                'amount'         => $session->amount_total,
                'currency'       => $session->currency,
                'payment_status' => $session->payment_status,
                'created'        => $session->created,
            ];

            Session::put('after_success_url', $after_success_url);
            Session::put('paid_amount', $session->amount_total);
            Session::put('after_success_gateway', 'Stripe');
            Session::put('after_success_transaction', $session->payment_intent);
            Session::put('payment_details', $paymentDetails);

            return redirect($after_success_url);
        }

        $after_faild_url = Session::get('after_faild_url');
        return redirect($after_faild_url);
    }

    /**
     * @return mixed
     */
    public function pay_via_paypal()
    {

        $basic_payment = $this->get_basic_payment_info();

        $payable_amount = 100; /**
         * developer need to assign the amount here
         */
        $after_success_url = route('payment-addon-success');
        $after_faild_url   = route('payment-addon-faild');

        $paypal_credentials = (object) [
            'paypal_client_id'    => $basic_payment->paypal_client_id,
            'paypal_secret_key'   => $basic_payment->paypal_secret_key,
            'paypal_account_mode' => $basic_payment->paypal_account_mode,
        ];

        $user = Auth::guard('web')->user();

        $paypal_payment = new FrontPaymentController();

        return $paypal_payment->pay_with_paypal($paypal_credentials, $payable_amount, $after_success_url, $after_faild_url, $user);

    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function pay_via_bank(Request $request)
    {

        $payable_amount = 100; /**
         * developer need to assign the amount here
         */
        $after_success_url = route('payment-addon-success');
        $after_faild_url   = route('payment-addon-faild');

        $user = Auth::guard('web')->user();

        Session::put('after_success_url', $after_success_url);
        Session::put('after_faild_url', $after_faild_url);
        Session::put('payable_amount', $payable_amount);
        Session::put('after_success_gateway', 'Direct Bank');
        Session::put('after_success_transaction', $request->bank_transaction);

        return $this->payment_addon_success();
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function pay_via_razorpay(Request $request)
    {

        $payment_setting = $this->get_payment_gateway_info();

        $after_success_url = route('payment-addon-success');
        $after_faild_url   = route('payment-addon-faild');

        $user = Auth::guard('web')->user();

        $razorpay_credentials = (object) [
            'razorpay_key'    => $payment_setting->razorpay_key,
            'razorpay_secret' => $payment_setting->razorpay_secret,
        ];

        $razorpay_payment = new AddonPaymentController();

        return $razorpay_payment->pay_with_razorpay($request, $razorpay_credentials, $request->payable_amount, $after_success_url, $after_faild_url, $user);

    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function pay_via_mollie(Request $request)
    {

        $payable_amount = 100; /**
         * developer need to assign the amount here
         */
        $after_success_url = route('payment-addon-success');
        $after_faild_url   = route('payment-addon-faild');

        $user = Auth::guard('web')->user();

        $payment_setting = $this->get_payment_gateway_info();

        $mollie_credentials = (object) [
            'mollie_key' => $payment_setting->mollie_key,
        ];

        $mollie_payment = new AddonPaymentController();

        return $mollie_payment->pay_with_mollie($mollie_credentials, $payable_amount, $after_success_url, $after_faild_url, $user);
    }

    /**
     * @return mixed
     */
    public function pay_via_instamojo()
    {

        $payable_amount = 100; /**
         * developer need to assign the amount here
         */
        $after_success_url = route('payment-addon-success');
        $after_faild_url   = route('payment-addon-faild');

        $user = Auth::guard('web')->user();

        $payment_setting = $this->get_payment_gateway_info();

        $instamojo_credentials = (object) [
            'instamojo_api_key'    => $payment_setting->instamojo_api_key,
            'instamojo_auth_token' => $payment_setting->instamojo_auth_token,
            'account_mode'         => $payment_setting->instamojo_account_mode,
        ];

        $instamojo_payment = new AddonPaymentController();

        return $instamojo_payment->pay_with_instamojo($instamojo_credentials, $payable_amount, $after_success_url, $after_faild_url, $user);
    }

    public function payment_addon_success()
    {

        $payable_amount = Session::get('payable_amount');
        $gateway_name   = Session::get('after_success_gateway');
        $transaction    = Session::get('after_success_transaction');

        /**write your project logic here after successfully payment, you can use above information if you need. */

        $user = Auth::guard('web')->user();

        $order                 = new Order();
        $order->user_id        = $user->id;
        $order->order_id       = substr(rand(0, time()), 0, 10);
        $order->total_amount   = $payable_amount;
        $order->transaction_id = $transaction;
        $order->payment_method = $gateway_name;
        $order->payment_status = $gateway_name == 'Direct Bank' ? 'pending' : 'success';
        $order->order_status   = 'success';
        $order->save();

        /**after write all logic you need to forget all session data*/
        // Session::forget('after_success_url');
        // Session::forget('after_faild_url');
        // Session::forget('payable_amount');
        // Session::forget('gateway_charge');
        // Session::forget('currency_rate');
        // Session::forget('after_success_gateway');
        // Session::forget('after_success_transaction');
        // Session::forget('payment_details');

        return view('payment_success');

    }

    public function payment_addon_faild()
    {

        /**you can write here your project related code */

        Session::forget('after_success_url');
        Session::forget('after_faild_url');
        Session::forget('payable_amount');
        Session::forget('gateway_charge');
        Session::forget('currency_rate');
        Session::forget('after_success_gateway');
        Session::forget('after_success_transaction');
        Session::forget('payment_details');

        $notification = __('Payment Failed please try again');
        $notification = ['message' => $notification, 'alert-type' => 'error'];

        return redirect()->route('payment')->with($notification);
    }
}
