<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Modules\BasicPayment\app\Models\BasicPayment;
use Modules\BasicPayment\app\Models\PaymentGateway;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\GlobalSetting\app\Models\Setting;

trait GetGlobalInformationTrait
{
    // get basic payment gateway information
    /**
     * @return mixed
     */
    public function getBasicPaymentInfo()
    {
        $basic_payment = Cache::rememberForever('basic_payment', function () {

            $payment_info = BasicPayment::get();

            $basic_payment = [];
            foreach ($payment_info as $payment_item) {
                $basic_payment[$payment_item->key] = $payment_item->value;
            }

            return (object) $basic_payment;
        });

        if (Setting::where('key', 'commission_type')->first()->value !== 'commission' && Session::has('order_provider_id')) {
            $user = User::findOrFail(Session::get('order_provider_id'));
            if ($user->is_provider == 1) {
                $basic_payment->stripe_key          = $user->providerGateways->where('key', 'stripe_key')->first()->value;
                $basic_payment->stripe_secret       = $user->providerGateways->where('key', 'stripe_secret')->first()->value;
                $basic_payment->stripe_status       = $user->providerGateways->where('key', 'stripe_status')->first()->value;
                $basic_payment->paypal_account_mode = $user->providerGateways->where('key', 'paypal_account_mode')->first()->value;
                $basic_payment->paypal_client_id    = $user->providerGateways->where('key', 'paypal_client_id')->first()->value;
                $basic_payment->paypal_secret_key   = $user->providerGateways->where('key', 'paypal_secret_key')->first()->value;
                $basic_payment->paypal_app_id       = $user->providerGateways->where('key', 'paypal_app_id')->first()->value;
                $basic_payment->paypal_status       = $user->providerGateways->where('key', 'paypal_status')->first()->value;
                $basic_payment->bank_information    = $user->providerGateways->where('key', 'bank_information')->first()->value;
                $basic_payment->bank_status         = $user->providerGateways->where('key', 'bank_status')->first()->value;
            }
        }

        return $basic_payment;
    }

    // get addon payment gateway information
    /**
     * @return mixed
     */
    public function getPaymentGatewayInfo()
    {
        $payment_setting = Cache::rememberForever('payment_setting', function () {

            $payment_info = PaymentGateway::get();

            $payment_setting = [];
            foreach ($payment_info as $payment_item) {
                $payment_setting[$payment_item->key] = $payment_item->value;
            }

            return (object) $payment_setting;
        });

        if (Setting::where('key', 'commission_type')->first()->value !== 'commission' && Session::has('order_provider_id')) {
            $user = User::findOrFail(Session::get('order_provider_id'));
            if ($user->is_provider == 1) {
                $payment_setting->razorpay_key    = $user->providerGateways->where('key', 'razorpay_key')->first()->value;
                $payment_setting->razorpay_secret = $user->providerGateways->where('key', 'razorpay_secret')->first()->value;
                $payment_setting->razorpay_status = $user->providerGateways->where('key', 'razorpay_status')->first()->value;

                $payment_setting->flutterwave_public_key = $user->providerGateways->where('key', 'flutterwave_public_key')->first()->value;
                $payment_setting->flutterwave_secret_key = $user->providerGateways->where('key', 'flutterwave_secret_key')->first()->value;
                $payment_setting->flutterwave_status     = $user->providerGateways->where('key', 'flutterwave_status')->first()->value;

                $payment_setting->paystack_public_key = $user->providerGateways->where('key', 'paystack_public_key')->first()->value;
                $payment_setting->paystack_secret_key = $user->providerGateways->where('key', 'paystack_secret_key')->first()->value;
                $payment_setting->paystack_status     = $user->providerGateways->where('key', 'paystack_status')->first()->value;

                $payment_setting->mollie_key    = $user->providerGateways->where('key', 'mollie_key')->first()->value;
                $payment_setting->mollie_status = $user->providerGateways->where('key', 'mollie_status')->first()->value;

                $payment_setting->instamojo_client_id     = $user->providerGateways->where('key', 'instamojo_client_id')->first()->value;
                $payment_setting->instamojo_client_secret = $user->providerGateways->where('key', 'instamojo_client_secret')->first()->value;
                $payment_setting->instamojo_account_mode  = $user->providerGateways->where('key', 'instamojo_account_mode')->first()->value;
                $payment_setting->instamojo_status        = $user->providerGateways->where('key', 'instamojo_status')->first()->value;

                $payment_setting->sslcommerz_store_id       = $user->providerGateways->where('key', 'sslcommerz_store_id')->first()->value;
                $payment_setting->sslcommerz_store_password = $user->providerGateways->where('key', 'sslcommerz_store_password')->first()->value;
                $payment_setting->sslcommerz_status         = $user->providerGateways->where('key', 'sslcommerz_status')->first()->value;
                $payment_setting->sslcommerz_test_mode      = $user->providerGateways->where('key', 'sslcommerz_test_mode')->first()->value;
                $payment_setting->sslcommerz_localhost      = $user->providerGateways->where('key', 'sslcommerz_localhost')->first()->value;

                $payment_setting->crypto_sandbox          = $user->providerGateways->where('key', 'crypto_sandbox')->first()->value;
                $payment_setting->crypto_api_key          = $user->providerGateways->where('key', 'crypto_api_key')->first()->value;
                $payment_setting->crypto_status           = $user->providerGateways->where('key', 'crypto_status')->first()->value;
                $payment_setting->crypto_receive_currency = $user->providerGateways->where('key', 'crypto_receive_currency')->first()->value ?? 'BTC';
            }
        }

        return $payment_setting;
    }

    private function getMultiCurrencyInfo()
    {
        $gateway_currency = allCurrencies()->where('currency_code', getSessionCurrency())->first();

        return [
            'currency_code' => $gateway_currency->currency_code,
            'country_code'  => $gateway_currency->country_code,
            'currency_rate' => $gateway_currency->currency_rate,
            'currency_id'   => $gateway_currency->id,
        ];
    }

    /**
     * @param $currencyId
     */
    private function getCurrencyDetails($currencyId)
    {
        $gateway_currency = MultiCurrency::where('id', $currencyId)->first();

        return [
            'currency_code' => $gateway_currency?->currency_code,
            'country_code'  => $gateway_currency?->country_code,
            'currency_rate' => $gateway_currency?->currency_rate,
        ];
    }

    /**
     * @param $payable_amount
     * @param $gateway_name
     */
    public function calculatePayableCharge($payable_amount, $gateway_name)
    {
        $paymentService = app(PaymentMethodService::class);

        $paymentDetails = $paymentService->getGatewayDetails($gateway_name);

        $currencyId     = $paymentDetails->currency_id ?? '';
        $gateway_charge = $paymentDetails->charge;

        $currencyDetails = $this->getCurrencyDetails($currencyId);
        $currency_code   = $currencyDetails['currency_code'];
        $country_code    = $currencyDetails['country_code'];
        $currency_rate   = $currencyDetails['currency_rate'];

        getSessionCurrency();

        if ($paymentService->isSupportsMultiCurrency($gateway_name) && session()->has('currency_code')) {
            $multiCurrencyInfo = $this->getMultiCurrencyInfo();
            $currency_code     = $multiCurrencyInfo['currency_code'];
            $country_code      = $multiCurrencyInfo['country_code'];
            $currency_rate     = $multiCurrencyInfo['currency_rate'];
            $currency_id       = $multiCurrencyInfo['currency_id'];
        }

        $payable_amount      = $payable_amount * $currency_rate;
        $gateway_charge      = $payable_amount * ($gateway_charge / 100);
        $payable_with_charge = $payable_amount + $gateway_charge;
        $payable_with_charge = sprintf('%0.2f', $payable_with_charge);

        session()->put('gateway_charge', $gateway_charge);
        session()->put('payable_currency', $currency_code);

        return (object) [
            'country_code'        => $country_code,
            'currency_code'       => $currency_code,
            'currency_id'         => $currency_id ?? $currencyId,
            'gateway_charge'      => $gateway_charge,
            'payable_with_charge' => $payable_with_charge,
            'payable_amount'      => $payable_amount,
        ];
    }
}
