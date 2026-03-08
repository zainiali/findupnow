<?php

namespace Modules\BasicPayment\app\Services;

use Modules\BasicPayment\app\Enums\PaymentGatewaySupportedCurrencyListEnum;
use Modules\BasicPayment\app\Services\PaymentMethodService;

class PaymentGatewayService extends PaymentMethodService
{
    const MOLLIE = 'mollie';

    const RAZORPAY = 'razorpay';

    const FLUTTERWAVE = 'flutterwave';

    const INSTAMOJO = 'instamojo';

    const PAYSTACK = 'paystack';

    const SSLCOMMERZ = 'sslcommerz';

    const CRYPTO = 'crypto';

    /**
     * @var mixed
     */
    protected $previousService;

    /**
     * @var mixed
     */
    private $paymentSetting;

    /**
     * @var mixed
     */
    private $activeStatus;

    /**
     * @param PaymentMethodService $previousService
     */
    public function __construct(?PaymentMethodService $previousService = null)
    {
        if (is_null($previousService)) {
            $previousService = PaymentMethodService::class;
        }

        $this->previousService = $previousService;

        $this->paymentSetting = $this->getPaymentGatewayInfo();

        $this->activeStatus = 'active';

        self::extendSupportedPayments([
            self::RAZORPAY,
            self::FLUTTERWAVE,
            self::MOLLIE,
            self::INSTAMOJO,
            self::PAYSTACK,
            self::SSLCOMMERZ,
            self::CRYPTO,
        ]);

        self::extendMultiCurrencySupported([
            self::RAZORPAY,
            self::FLUTTERWAVE,
            self::MOLLIE,
            self::INSTAMOJO,
            self::PAYSTACK,
            self::SSLCOMMERZ,
            self::CRYPTO,
        ]);

        self::additionalActiveGatewaysList([
            self::RAZORPAY    => [
                'name'       => 'RazorPay',
                'logo'       => asset($this->paymentSetting->razorpay_image ?? 'uploads/website-images/razorpay.webp'),
                'status'     => $this->paymentSetting->razorpay_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getRazorpaySupportedCurrencies(),
            ],
            self::FLUTTERWAVE => [
                'name'       => 'FlutterWave',
                'logo'       => asset($this->paymentSetting->flutterwave_image ?? 'uploads/website-images/flutterwave.webp'),
                'status'     => $this->paymentSetting->flutterwave_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getFlutterwaveSupportedCurrencies(),
            ],
            self::PAYSTACK    => [
                'name'       => 'PayStack',
                'logo'       => asset($this->paymentSetting->paystack_image ?? 'uploads/website-images/paystack.webp'),
                'status'     => $this->paymentSetting->paystack_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getPaystackSupportedCurrencies(),
            ],
            self::MOLLIE      => [
                'name'       => 'Mollie',
                'logo'       => asset($this->paymentSetting->mollie_image ?? 'uploads/website-images/mollie.webp'),
                'status'     => $this->paymentSetting->mollie_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getMollieSupportedCurrencies(),
            ],
            self::INSTAMOJO   => [
                'name'       => 'Instamojo',
                'logo'       => asset($this->paymentSetting->instamojo_image ?? 'uploads/website-images/instamojo.webp'),
                'status'     => $this->paymentSetting->instamojo_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getInstamojoSupportedCurrencies(),
            ],
            self::SSLCOMMERZ  => [
                'name'       => 'Sslcommerz',
                'logo'       => asset($this->paymentSetting->sslcommerz_image ?? 'uploads/website-images/bank-pay.webp'),
                'status'     => $this->paymentSetting->sslcommerz_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getSslcommerzSupportedCurrencies(),
            ],
            self::CRYPTO      => [
                'name'       => 'Crypto',
                'logo'       => asset($this->paymentSetting->crypto_image ?? 'uploads/website-images/bank-pay.webp'),
                'status'     => $this->paymentSetting->crypto_status == $this->activeStatus,
                'currencies' => PaymentGatewaySupportedCurrencyListEnum::getCryptoSupportedCurrencies(),
            ],
        ]);

    }

    /**
     * @param string $gatewayName
     */
    public function getPaymentName(string $gatewayName): ?string
    {
        return match ($gatewayName) {
            self::RAZORPAY => 'Razorpay',
            self::FLUTTERWAVE => 'Flutterwave',
            self::MOLLIE => 'Mollie',
            self::INSTAMOJO => 'Instamojo',
            self::PAYSTACK => 'Paystack',
            self::SSLCOMMERZ => 'Sslcommerz',
            self::CRYPTO => 'Crypto',
            default => $this->previousService->getPaymentName($gatewayName),
        };
    }

    /**
     * @param string $gatewayName
     */
    public function getGatewayDetails(string $gatewayName): ?object
    {
        $paymentSetting = $this->getPaymentGatewayInfo();

        return match ($gatewayName) {
            self::RAZORPAY => (object) [
                'razorpay_key'         => $paymentSetting->razorpay_key ?? null,
                'razorpay_secret'      => $paymentSetting->razorpay_secret ?? null,
                'razorpay_name'        => $paymentSetting->razorpay_name ?? null,
                'razorpay_description' => $paymentSetting->razorpay_description ?? null,
                'razorpay_theme_color' => $paymentSetting->razorpay_theme_color ?? null,
                'razorpay_status'      => $paymentSetting->razorpay_status ?? 'inactive',
                'razorpay_image'       => $paymentSetting->razorpay_image ?? null,
                'currency_id'          => $paymentSetting->razorpay_currency_id ?? null,
                'charge'               => $paymentSetting->razorpay_charge ?? null,
            ],
            self::FLUTTERWAVE => (object) [
                'flutterwave_public_key' => $paymentSetting->flutterwave_public_key ?? null,
                'flutterwave_secret_key' => $paymentSetting->flutterwave_secret_key ?? null,
                'flutterwave_app_name'   => $paymentSetting->flutterwave_app_name ?? null,
                'charge'                 => $paymentSetting->flutterwave_charge ?? null,
                'currency_id'            => $paymentSetting->flutterwave_currency_id ?? null,
                'flutterwave_status'     => $paymentSetting->flutterwave_status ?? 'inactive',
                'flutterwave_image'      => $paymentSetting->flutterwave_image ?? null,
            ],
            self::PAYSTACK => (object) [
                'paystack_public_key' => $paymentSetting->paystack_public_key ?? null,
                'paystack_secret_key' => $paymentSetting->paystack_secret_key ?? null,
                'paystack_status'     => $paymentSetting->paystack_status ?? 'inactive',
                'charge'              => $paymentSetting->paystack_charge ?? null,
                'paystack_image'      => $paymentSetting->paystack_image ?? null,
                'currency_id'         => $paymentSetting->paystack_currency_id ?? null,
            ],
            self::MOLLIE => (object) [
                'mollie_key'    => $paymentSetting->mollie_key ?? null,
                'charge'        => $paymentSetting->mollie_charge ?? null,
                'mollie_image'  => $paymentSetting->mollie_image ?? null,
                'mollie_status' => $paymentSetting->mollie_status ?? 'inactive',
                'currency_id'   => $paymentSetting->mollie_currency_id ?? null,
            ],
            self::INSTAMOJO => (object) [
                'instamojo_account_mode'  => $paymentSetting->instamojo_account_mode ?? null,
                'instamojo_client_id'     => $paymentSetting->instamojo_client_id ?? null,
                'instamojo_client_secret' => $paymentSetting->instamojo_client_secret ?? null,
                'charge'                  => $paymentSetting->instamojo_charge ?? null,
                'instamojo_image'         => $paymentSetting->instamojo_image ?? null,
                'currency_id'             => $paymentSetting->instamojo_currency_id ?? null,
                'instamojo_status'        => $paymentSetting->instamojo_status ?? 'inactive',
            ],
            self::SSLCOMMERZ => (object) [
                'sslcommerz_store_id'       => $paymentSetting->sslcommerz_store_id ?? null,
                'sslcommerz_store_password' => $paymentSetting->sslcommerz_store_password ?? null,
                'sslcommerz_image'          => $paymentSetting->sslcommerz_image ?? null,
                'sslcommerz_test_mode'      => $paymentSetting->sslcommerz_test_mode ?? 1,
                'sslcommerz_localhost'      => $paymentSetting->sslcommerz_localhost ?? 1,
                'sslcommerz_status'         => $paymentSetting->sslcommerz_status ?? 'inactive',
                'charge'                    => $paymentSetting->sslcommerz_charge ?? null,
            ],
            self::CRYPTO => (object) [
                'crypto_sandbox'          => $paymentSetting->crypto_sandbox ?? null,
                'crypto_api_key'          => $paymentSetting->crypto_api_key ?? null,
                'crypto_image'            => $paymentSetting->crypto_image ?? null,
                'crypto_status'           => $paymentSetting->crypto_status ?? 'inactive',
                'crypto_receive_currency' => $paymentSetting->crypto_receive_currency ?? null,
                'charge'                  => $paymentSetting->crypto_charge ?? null,
            ],
            default => $this->previousService->getGatewayDetails($gatewayName),
        };
    }

    /**
     * @param string $gatewayName
     */
    public function isActive(string $gatewayName): bool
    {
        $gatewayDetails = $this->getGatewayDetails($gatewayName);
        $activeStatus   = config('services.default_status.active_text');

        return match ($gatewayName) {
            self::MOLLIE => $gatewayDetails->mollie_status == $activeStatus,
            self::RAZORPAY => $gatewayDetails->razorpay_status == $activeStatus,
            self::FLUTTERWAVE => $gatewayDetails->flutterwave_status == $activeStatus,
            self::INSTAMOJO => $gatewayDetails->instamojo_status == $activeStatus,
            self::PAYSTACK => $gatewayDetails->paystack_status == $activeStatus,
            self::SSLCOMMERZ => $gatewayDetails->sslcommerz_status == $activeStatus,
            self::CRYPTO => $gatewayDetails->crypto_status == $activeStatus,
            default => $this->previousService->isActive($gatewayName),
        };
    }

    /**
     * @param string $gatewayName
     */
    public function getIcon(string $gatewayName): string
    {
        return match ($gatewayName) {
            self::MOLLIE => 'fa-cc-mollie',
            self::RAZORPAY => 'fa-cc-razorpay',
            self::FLUTTERWAVE => 'fa-cc-flutterwave',
            self::INSTAMOJO => 'fa-cc-instamojo',
            self::PAYSTACK => 'fa-cc-paystack',
            self::SSLCOMMERZ => 'fa-money-bill-alt',
            self::CRYPTO => 'fa-money-bill-alt',
            default => $this->previousService->getIcon($gatewayName),
        };
    }

    /**
     * @param $gatewayName
     */
    public function getLogo($gatewayName): ?string
    {
        $paymentSetting = $this->getPaymentGatewayInfo();

        return match ($gatewayName) {
            self::MOLLIE => $paymentSetting->mollie_image ? asset($paymentSetting->mollie_image) : asset('uploads/website-images/mollie.webp'),
            self::RAZORPAY => $paymentSetting->razorpay_image ? asset($paymentSetting->razorpay_image) : asset('uploads/website-images/razorpay.webp'),
            self::FLUTTERWAVE => $paymentSetting->flutterwave_image ? asset($paymentSetting->flutterwave_image) : asset('uploads/website-images/flutterwave.webp'),
            self::INSTAMOJO => $paymentSetting->instamojo_image ? asset($paymentSetting->instamojo_image) : asset('uploads/website-images/instamojo.webp'),
            self::PAYSTACK => $paymentSetting->paystack_image ? asset($paymentSetting->paystack_image) : asset('uploads/website-images/paystack.webp'),
            self::SSLCOMMERZ => $paymentSetting->sslcommerz_image ? asset($paymentSetting->sslcommerz_image) : asset('uploads/website-images/bank-pay.webp'),
            self::CRYPTO => $paymentSetting->crypto_image ? asset($paymentSetting->crypto_image) : asset('uploads/website-images/bank-pay.webp'),
            default => $this->previousService->getLogo($gatewayName),
        };
    }

    /**
     * @param $gatewayName
     * @param $code
     */
    public function isCurrencySupported($gatewayName, $code = null): bool
    {
        if (is_null($code)) {
            $code = getSessionCurrency();
        }

        return match ($gatewayName) {
            self::MOLLIE => PaymentGatewaySupportedCurrencyListEnum::isMollieSupportedCurrencies($code),
            self::RAZORPAY => PaymentGatewaySupportedCurrencyListEnum::isRazorpaySupportedCurrencies($code),
            self::FLUTTERWAVE => PaymentGatewaySupportedCurrencyListEnum::isFlutterwaveSupportedCurrencies($code),
            self::INSTAMOJO => PaymentGatewaySupportedCurrencyListEnum::isInstamojoSupportedCurrencies($code),
            self::PAYSTACK => PaymentGatewaySupportedCurrencyListEnum::isPaystackSupportedCurrencies($code),
            self::SSLCOMMERZ => PaymentGatewaySupportedCurrencyListEnum::isSslcommerzSupportedCurrencies($code),
            self::CRYPTO => PaymentGatewaySupportedCurrencyListEnum::isCryptoSupportedCurrencies($code),
            default => $this->previousService->isCurrencySupported($gatewayName, $code),
        };
    }

    /**
     * @param $gatewayName
     */
    public function getSupportedCurrencies($gatewayName): array
    {
        return match ($gatewayName) {
            self::MOLLIE => PaymentGatewaySupportedCurrencyListEnum::getMollieSupportedCurrencies(),
            self::RAZORPAY => PaymentGatewaySupportedCurrencyListEnum::getRazorpaySupportedCurrencies(),
            self::FLUTTERWAVE => PaymentGatewaySupportedCurrencyListEnum::getFlutterwaveSupportedCurrencies(),
            self::INSTAMOJO => PaymentGatewaySupportedCurrencyListEnum::getInstamojoSupportedCurrencies(),
            self::PAYSTACK => PaymentGatewaySupportedCurrencyListEnum::getPaystackSupportedCurrencies(),
            self::SSLCOMMERZ => PaymentGatewaySupportedCurrencyListEnum::getSslcommerzSupportedCurrencies(),
            self::CRYPTO => PaymentGatewaySupportedCurrencyListEnum::getCryptoSupportedCurrencies(),
            default => $this->previousService->getSupportedCurrencies($gatewayName),
        };
    }

    /**
     * @param string $gatewayName
     */
    public function getBladeView(string $gatewayName): ?string
    {
        return match ($gatewayName) {
            self::MOLLIE => 'basicpayment::gateway-actions.mollie',
            self::RAZORPAY => 'basicpayment::gateway-actions.razorpay',
            self::FLUTTERWAVE => 'basicpayment::gateway-actions.flutterwave',
            self::INSTAMOJO => 'basicpayment::gateway-actions.instamojo',
            self::PAYSTACK => 'basicpayment::gateway-actions.paystack',
            self::SSLCOMMERZ => 'basicpayment::gateway-actions.sslcommerz',
            self::CRYPTO => 'basicpayment::gateway-actions.crypto',
            default => $this->previousService->getBladeView($gatewayName),
        };
    }
}
