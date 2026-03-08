<?php

namespace App\Traits;

use App\Enums\UserStatus;
use App\Models\ProviderPaymentGateway;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait NewUserCreateTrait
{
    use GlobalMailTrait;

    /**
     * @param  $callbackUser
     * @param  $provider_name
     * @param  $user
     * @return mixed
     */
    private function createNewUser($callbackUser, $provider_name, $user)
    {
        if (!$user) {
            $password = Str::random(10);
            $user     = User::create([
                'name'              => $callbackUser->name,
                'email'             => $callbackUser->email,
                'status'            => UserStatus::ACTIVE->value,
                'is_banned'         => UserStatus::UNBANNED->value,
                'email_verified_at' => now(),
                'password'          => Hash::make($password),
            ]);
            try {
                [$subject, $message] = $this->fetchEmailTemplate('social_login', ['user_name' => $user->name, 'app_name' => config('app.name'), 'password' => $password]);
                $this->sendMail($user->email, $subject, $message);
            } catch (Exception $e) {
                session(['error' => $e->getMessage()]);
                Log::error($e);
            }
        }

        $socialite = $user->socialite()->create([
            'provider_name' => $provider_name,
            'provider_id'   => $callbackUser->getId(),
            'access_token'  => $callbackUser->token ?? null,
            'refresh_token' => $callbackUser->refreshToken ?? null,
        ]);

        return $socialite;
    }

    /**
     * @param $user
     */
    private static function addProviderGateways($user)
    {
        try {
            $data = [
                "razorpay_key"              => "razorpay_key",
                "razorpay_secret"           => "razorpay_secret",
                "razorpay_name"             => "WebSolutionUs",
                "razorpay_description"      => "This is test payment window",
                "razorpay_charge"           => 0.15,
                "razorpay_theme_color"      => "#6d0ce4",
                "razorpay_status"           => "inactive",
                "razorpay_currency_id"      => 3,
                "razorpay_image"            => "website/images/gateways/razorpay.webp",
                "flutterwave_public_key"    => "flutterwave_public_key",
                "flutterwave_secret_key"    => "flutterwave_secret_key",
                "flutterwave_app_name"      => "WebSolutionUs",
                "flutterwave_charge"        => 0,
                "flutterwave_currency_id"   => 2,
                "flutterwave_status"        => "inactive",
                "flutterwave_image"         => "website/images/gateways/flutterwave.webp",
                "paystack_public_key"       => "paystack_public_key",
                "paystack_secret_key"       => "paystack_secret_key",
                "paystack_status"           => "inactive",
                "paystack_charge"           => 0,
                "paystack_image"            => "website/images/gateways/paystack.webp",
                "paystack_currency_id"      => 2,
                "mollie_key"                => "mollie_key",
                "mollie_charge"             => 0,
                "mollie_image"              => "website/images/gateways/mollie.webp",
                "mollie_status"             => "inactive",
                "mollie_currency_id"        => 5,
                "instamojo_account_mode"    => "Sandbox",
                "instamojo_client_id"       => "instamojo_client_id",
                "instamojo_client_secret"   => "instamojo_client_secret",
                "instamojo_charge"          => 0,
                "instamojo_image"           => "website/images/gateways/instamojo.webp",
                "instamojo_currency_id"     => 3,
                "instamojo_status"          => "inactive",
                "sslcommerz_store_id"       => "sslcommerz_store_id",
                "sslcommerz_store_password" => "sslcommerz_store_password@ssl",
                "sslcommerz_image"          => "website/images/gateways/sslcommerz.webp",
                "sslcommerz_test_mode"      => 0,
                "sslcommerz_localhost"      => 0,
                "sslcommerz_status"         => "inactive",
                "sslcommerz_charge"         => 0,
                "crypto_sandbox"            => 1,
                "crypto_api_key"            => "crypto_api_key",
                "crypto_image"              => "website/images/gateways/crypto.webp",
                "crypto_status"             => "inactive",
                "crypto_charge"             => 0,
                "crypto_receive_currency"   => 'BTC',
                "stripe_key"                => "stripe_key",
                "stripe_secret"             => "stripe_secret",
                "stripe_currency_id"        => 1,
                "stripe_status"             => "inactive",
                "stripe_charge"             => 0,
                "stripe_image"              => "website/images/gateways/stripe.webp",
                "paypal_client_id"          => "paypal_client_id",
                "paypal_secret_key"         => "paypal_secret_key",
                "paypal_account_mode"       => "sandbox",
                "paypal_app_id"             => "paypal_app_id",
                "paypal_currency_id"        => 1,
                "paypal_charge"             => 0,
                "paypal_status"             => "inactive",
                "paypal_image"              => "website/images/gateways/paypal.webp",
                "bank_information"          => "Bank Name => Your bank name
            Account Number => Your bank account number
            Routing Number => Your bank routing number
            Branch => Your bank branch name",
                "bank_status"               => "active",
                "bank_image"                => "website/images/gateways/bank.webp",
                "bank_charge"               => 0,
                "bank_currency_id"          => 1,
            ];

            if ($user->is_provider == 1) {
                foreach ($data as $key => $value) {
                    if (ProviderPaymentGateway::where([
                        'user_id' => $user->id,
                        'key'     => $key,
                    ])->doesntExist()) {
                        $table          = new ProviderPaymentGateway();
                        $table->user_id = $user->id;
                        $table->key     = $key;
                        $table->value   = $value;
                        $table->save();
                    }
                }
            }
        } catch (Exception $e) {
            logger()->error('Unable to create default data for provider payment gateways. user id:' . $user->id . ' error:' . $e->getMessage());
        }
    }
}
