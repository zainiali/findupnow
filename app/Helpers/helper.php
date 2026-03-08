<?php

use App\Exceptions\AccessPermissionDeniedException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\BasicPayment\app\Enums\BasicPaymentSupportedCurrencyListEnum;
use Modules\BasicPayment\app\Models\BasicPayment;
use Modules\BasicPayment\app\Models\PaymentGateway;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\GlobalSetting\app\Models\CustomCode;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\Language\app\Models\Language;
use Modules\PageBuilder\app\Models\CustomizeablePage;
use Nwidart\Modules\Facades\Module;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

/**
 * @param  string|null $oldFile
 * @return mixed
 */
function saveFileGetPath(UploadedFile $file, string $path = 'uploads/custom-images/', string | null $oldFile = '', bool $optimize = false)
{
    $extension = $file->getClientOriginalExtension();
    $file_name = 'wsus-img' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extension;
    $file_name = $path . $file_name;
    $file->move(public_path($path), $file_name);

    try {
        if ($oldFile && !str($oldFile)->contains('uploads/website-images') && File::exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        if ($optimize) {
            ImageOptimizer::optimize(public_path($file_name));
        }
    } catch (Exception $e) {
        Log::info($e->getMessage());
    }

    return $file_name;
}

// file upload method
if (!function_exists('allLanguages')) {
    /**
     * @return mixed
     */
    function allLanguages()
    {
        $allLanguages = Cache::rememberForever('allLanguages', function () {
            return Language::select('code', 'name', 'direction', 'status', 'is_default')->get();
        });

        if (!$allLanguages) {
            $allLanguages = Language::select('code', 'name', 'direction', 'status', 'is_default')->get();
        }

        return $allLanguages;
    }
}

if (!function_exists('getSessionLanguage')) {
    /**
     * @return mixed
     */
    function getSessionLanguage(): string
    {
        if (!session()->has('lang')) {
            session()->put('lang', getDefaultLanguage()->code);
            session()->forget('text_direction');
            session()->put('text_direction', getDefaultLanguage()->direction);
        }

        return (string) Session::get('lang');
    }
}

if (!function_exists('setLanguage')) {
    /**
     * @param $code
     */
    function setLanguage($code): void
    {
        $lang = Language::whereCode($code)->first();

        if (session()->has('lang')) {
            sessionForgetLangChang();
        }

        if ($lang) {
            session()->put('lang', $lang->code);
            session()->put('text_direction', $lang->direction);
        } else {
            session()->put('lang', getDefaultLanguage()->code);
            session()->put('text_direction', getDefaultLanguage()->direction);
        }
    }
}

if (!function_exists('getDefaultLanguage')) {
    /**
     * @param $code
     */
    function getDefaultLanguage(): object
    {
        if ($defaultLanguage = allLanguages()->where('is_default', 1)->first()) {
            $lang = (object) [
                'name'      => $defaultLanguage->name,
                'code'      => $defaultLanguage->code,
                'direction' => $defaultLanguage->direction,
                'status'    => $defaultLanguage->status,
            ];
        } else {
            $lang = (object) [
                'code'      => config('app.locale'),
                'name'      => 'English',
                'direction' => 'ltr',
                'status'    => '1',
            ];
        }

        return $lang;
    }
}

if (!function_exists('sessionForgetLangChang')) {
    function sessionForgetLangChang()
    {
        session()->forget('lang');
        session()->forget('text_direction');
    }
}

if (!function_exists('allCurrencies')) {
    /**
     * @return mixed
     */
    function allCurrencies()
    {
        $allCurrencies = Cache::rememberForever('allCurrencies', function () {
            return MultiCurrency::all();
        });

        if (!$allCurrencies) {
            $allCurrencies = MultiCurrency::all();
        }

        return $allCurrencies;
    }
}

if (!function_exists('getSessionCurrency')) {
    function getSessionCurrency(): string
    {
        if (!session()->has('currency_code') || !session()->has('currency_rate') || !session()->has('currency_position')) {
            $currency = allCurrencies()->where('is_default', 'yes')->first();
            session()->put('currency_code', $currency->currency_code);
            session()->forget('currency_position');
            session()->put('currency_position', $currency->currency_position);
            session()->forget('currency_icon');
            session()->put('currency_icon', $currency->currency_icon);
            session()->forget('currency_rate');
            session()->put('currency_rate', $currency->currency_rate);
        }

        return Session::get('currency_code');
    }
}

function admin_lang()
{
    return Session::get('admin_lang');
}

// calculate currency
/**
 * @return mixed
 */
if (!function_exists('currency')) {
    /**
     * @param  $price
     * @param  $currency
     * @param  null        $icon
     * @return mixed
     */
    function currency($price, $currency = null, $icon = true)
    {
        if ($currency) {
            $multiCurrency = allCurrencies()->where('currency_code', $currency)->first();

            if ($multiCurrency) {
                $currency_icon     = $multiCurrency->currency_icon;
                $currency_rate     = $multiCurrency->currency_rate;
                $currency_position = $multiCurrency->currency_position;
            }
        } else {
            $currency          = getSessionCurrency();
            $currency_icon     = session()->get('currency_icon');
            $currency_rate     = session()->get('currency_rate', 1);
            $currency_position = session()->get('currency_position');
        }

        return $icon ? formatCurrency(formatPrice($price, $currency_rate), $currency_icon, $currency_position) : formatPrice($price, $currency_rate);
    }

    /**
     * @param $price
     * @param $rate
     */
    function formatPrice($price, $rate): string
    {
        $price = floatval($price) * floatval($rate);

        return number_format($price, 2, '.', ',');
    }

    /**
     * @param  $price
     * @param  $icon
     * @param  $position
     * @return mixed
     */
    function formatCurrency($price, $icon, $position): string
    {
        switch ($position) {
            case 'before_price':
                $formatted_price = $icon . $price;
                break;
            case 'before_price_with_space':
                $formatted_price = $icon . ' ' . $price;
                break;
            case 'after_price':
                $formatted_price = $price . $icon;
                break;
            case 'after_price_with_space':
                $formatted_price = $price . ' ' . $icon;
                break;
            default:
                $formatted_price = $icon . $price;
                break;
        }

        return $formatted_price;
    }

    /**
     * @param string $formattedPrice
     */
    function revertFormattedPrice(string $formattedPrice): int
    {
        $number = str_replace(',', '', $formattedPrice);
        $number = round(floatval($number));

        return intval($number);
    }

    /**
     * @param  $price
     * @param  $format
     * @return mixed
     */
    function revertToUSD($price, $format = true)
    {
        if (str(getSessionCurrency())->lower() !== 'usd') {
            $multiCurrency = MultiCurrency::where('currency_code', getSessionCurrency())->first();

            if ($multiCurrency) {
                $currency_rate = $multiCurrency->currency_rate;
                $price         = floatval($price) / floatval($currency_rate);

                if ($format) {
                    return number_format($price, 2, '.', ',');
                } else {
                    return revertFormattedPrice($price);
                }
            }
        }

        return $price;
    }
}

// calculate currency

// custom decode and encode input value
/**
 * @return mixed
 */
function html_decode($text)
{
    $after_decode = htmlspecialchars_decode($text, ENT_QUOTES);

    return $after_decode;
}
if (!function_exists('currectUrlWithQuery')) {
    /**
     * @return mixed
     */
    function currectUrlWithQuery($code)
    {
        $currentUrlWithQuery = request()->fullUrl();

        // Parse the query string
        $parsedQuery = parse_url($currentUrlWithQuery, PHP_URL_QUERY);

        // Check if the 'code' parameter already exists
        $codeExists = false;
        if ($parsedQuery) {
            parse_str($parsedQuery, $queryArray);
            $codeExists = isset($queryArray['code']);
        }

        if ($codeExists) {
            $updatedUrlWithQuery = preg_replace('/(\?|&)code=[^&]*/', '$1code=' . $code, $currentUrlWithQuery);
        } else {
            $updatedUrlWithQuery = $currentUrlWithQuery . ($parsedQuery ? '&' : '?') . http_build_query(['code' => $code]);
        }

        return $updatedUrlWithQuery;
    }
}

if (!function_exists('checkAdminHasPermission')) {
    /**
     * @param $permission
     */
    function checkAdminHasPermission($permission): bool
    {
        return Auth::guard('admin')->user()->can($permission) ? true : false;
    }
}

if (!function_exists('checkAdminHasPermissionAndThrowException')) {
    /**
     * @param $permission
     */
    function checkAdminHasPermissionAndThrowException($permission)
    {
        if (!checkAdminHasPermission($permission)) {
            throw new AccessPermissionDeniedException();
        }
    }
}

if (!function_exists('getSettingStatus')) {
    /**
     * @return mixed
     */
    function getSettingStatus($key)
    {
        if (Cache::has('setting')) {
            $setting = Cache::get('setting');
            if (!is_null($key)) {
                return $setting->$key == 'active' ? true : false;
            }
        } else {
            try {
                return Setting::where('key', $key)->first()?->value == 'active' ? true : false;
            } catch (Exception $e) {
                Log::info($e->getMessage());

                return false;
            }
        }

        return false;
    }
}
if (!function_exists('checkCrentials')) {
    function checkCrentials()
    {
        if (Cache::has('setting') && $settings = Cache::get('setting')) {

            $checkCrentials = [];

            if ($settings->mail_host == 'mail_host' || $settings->mail_username == 'mail_username' || $settings->mail_password == 'mail_password' || $settings->mail_host == '' || $settings->mail_port == '' || $settings->mail_username == '' || $settings->mail_password == '') {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Mail credentails not found'),
                    'description' => __('This may create a problem while sending email. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.email-configuration',
                ];
            }

            if ($settings->recaptcha_status !== 'inactive' && ($settings->recaptcha_site_key == 'recaptcha_site_key' || $settings->recaptcha_secret_key == 'recaptcha_secret_key' || $settings->recaptcha_site_key == '' || $settings->recaptcha_secret_key == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Recaptcha credentails not found'),
                    'description' => __('This may create a problem while submitting any form submission from website. Please fill up the credential from google account.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }
            if ($settings->googel_tag_status !== 'inactive' && ($settings->googel_tag_id == 'googel_tag_id' || $settings->googel_tag_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Tag credentails not found'),
                    'description' => __('This may create a problem with analyzing your website through Google Tag Manager. Please fill in the credentials to avoid any issues.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->pixel_status !== 'inactive' && ($settings->pixel_app_id == 'pixel_app_id' || $settings->pixel_app_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Facebook Pixel credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->google_login_status !== 'inactive' && ($settings->gmail_client_id == 'google_client_id' || $settings->gmail_secret_id == 'google_secret_id' || $settings->gmail_client_id == '' || $settings->gmail_secret_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google login credentails not found'),
                    'description' => __('This may create a problem while logging in using google. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->google_analytic_status !== 'inactive' && ($settings->google_analytic_id == 'google_analytic_id' || $settings->google_analytic_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Analytic credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->tawk_status !== 'inactive' && ($settings->tawk_chat_link == 'tawk_chat_link' || $settings->tawk_chat_link == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Tawk Chat Link credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->pusher_status !== 'inactive' && ($settings->pusher_app_id == 'pusher_app_id' || $settings->pusher_app_key == 'pusher_app_key' || $settings->pusher_app_secret == 'pusher_app_secret' || $settings->pusher_app_cluster == 'pusher_app_cluster' || $settings->pusher_app_id == '' || $settings->pusher_app_key == '' || $settings->pusher_app_secret == '' || $settings->pusher_app_cluster == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Pusher credentails not found'),
                    'description' => __('This may create a problem while logging in using google. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            return (object) $checkCrentials;
        }

        if (!Cache::has('basic_payment') && Module::isEnabled('BasicPayment')) {
            Cache::rememberForever('basic_payment', function () {
                $payment_info  = BasicPayment::get();
                $basic_payment = [];
                foreach ($payment_info as $payment_item) {
                    $basic_payment[$payment_item->key] = $payment_item->value;
                }

                return (object) $basic_payment;
            });
        }

        if (Cache::has('basic_payment') && $basicPayment = Cache::get('basic_payment')) {
            if ($basicPayment->stripe_status !== 'inactive' && ($basicPayment->stripe_key == 'stripe_key' || $basicPayment->stripe_secret == 'stripe_secret' || $basicPayment->stripe_key == '' || $basicPayment->stripe_secret == '')) {

                return (object) [
                    'status'      => true,
                    'message'     => __('Stripe credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($basicPayment->paypal_status !== 'inactive' && ($basicPayment->paypal_client_id == 'paypal_client_id' || $basicPayment->paypal_secret_key == 'paypal_secret_key' || $basicPayment->paypal_client_id == '' || $basicPayment->paypal_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Paypal credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }
        }

        if (!Cache::has('payment_setting') && Module::isEnabled('PaymentGateway')) {
            Cache::rememberForever('payment_setting', function () {
                $payment_info    = PaymentGateway::get();
                $payment_setting = [];
                foreach ($payment_info as $payment_item) {
                    $payment_setting[$payment_item->key] = $payment_item->value;
                }

                return (object) $payment_setting;
            });
        }

        if (Cache::has('payment_setting') && $paymentAddons = Cache::get('payment_setting')) {
            if ($paymentAddons->razorpay_status !== 'inactive' && ($paymentAddons->razorpay_key == 'razorpay_key' || $paymentAddons->razorpay_secret == 'razorpay_secret' || $paymentAddons->razorpay_key == '' || $paymentAddons->razorpay_secret == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Razorpay credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($paymentAddons->flutterwave_status !== 'inactive' && ($paymentAddons->flutterwave_public_key == 'flutterwave_public_key' || $paymentAddons->flutterwave_secret_key == 'flutterwave_secret_key' || $paymentAddons->flutterwave_public_key == '' || $paymentAddons->flutterwave_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Flutterwave credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($paymentAddons->paystack_status !== 'inactive' && ($paymentAddons->paystack_public_key == 'paystack_public_key' || $paymentAddons->paystack_secret_key == 'paystack_secret_key' || $paymentAddons->paystack_public_key == '' || $paymentAddons->paystack_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Paystack credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($paymentAddons->mollie_status !== 'inactive' && ($paymentAddons->mollie_key == 'mollie_key' || $paymentAddons->mollie_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Mollie credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($paymentAddons->instamojo_status !== 'inactive' && ($paymentAddons->instamojo_api_key == 'instamojo_api_key' || $paymentAddons->instamojo_auth_token == 'instamojo_auth_token' || $paymentAddons->instamojo_api_key == '' || $paymentAddons->instamojo_auth_token == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Instamojo credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }
        }

        return false;
    }
}

if (!function_exists('isRoute')) {
    /**
     * @param array $route
     */
    function isRoute(string | array $route, string | null $returnValue = null)
    {
        if (is_array($route)) {
            foreach ($route as $value) {
                if (Route::is($value)) {
                    return is_null($returnValue) ? true : $returnValue;
                }
            }

            return false;
        }

        if (Route::is($route)) {
            return is_null($returnValue) ? true : $returnValue;
        }

        return false;
    }
}
if (!function_exists('customCode')) {
    function customCode()
    {
        return Cache::rememberForever('customCode', function () {
            return CustomCode::select('css', 'header_javascript', 'body_javascript', 'footer_javascript')->first();
        });
    }
}
if (!function_exists('customPages')) {
    function customPages()
    {
        return CustomizeablePage::with('translation')
            ->whereNotIn('slug', ['terms-contidions', 'privacy-policy'])
            ->where('status', 1)
            ->get();
    }
}

if (!function_exists('paidCurrencyReformat')) {
    /**
     * @return mixed
     */
    function paidCurrencyReformat($paid_amount, $payable_currency, $gateway_name)
    {
        $paymentService = app(PaymentMethodService::class);
        if ($paymentService->getValue($gateway_name) == str('Razorpay')->lower() || $paymentService->getValue($gateway_name) == str('Stripe')->lower()) {
            if ($paymentService->getValue($gateway_name) == str('Stripe')->lower()) {
                $allCurrencyCodes = BasicPaymentSupportedCurrencyListEnum::getStripeSupportedCurrencies();

                if (in_array(Str::upper($payable_currency), $allCurrencyCodes['non_zero_currency_codes'])) {
                    $paid_amount = $paid_amount;
                } elseif (in_array(Str::upper($payable_currency), $allCurrencyCodes['three_digit_currency_codes'])) {
                    $paid_amount = (int) rtrim(strval($paid_amount), '0');
                } else {
                    $paid_amount = floatval($paid_amount / 100);
                }
            } else {
                $paid_amount = floatval($paid_amount / 100);
            }
        }

        return $paid_amount;
    }
}

if (!function_exists('convertWithCurrencyRate')) {
    /**
     * @return mixed
     */
    function convertWithCurrencyRate($amount, $currency = 'usd')
    {
        $currency = str($currency)->upper();

        $targetCurrency = MultiCurrency::where('currency_code', $currency)->first();

        return $targetCurrency ? round(floatval($amount) * floatval($targetCurrency->currency_rate), 2) : round($amount, 2);
    }
}

if (!function_exists('setTheme')) {
    function setTheme()
    {
        $setting = Setting::where('key', 'selected_theme')->first();

        if ($setting->value == 0) {
            if (request()->has('theme')) {
                $theme = request()->theme;
                if ($theme == 1) {
                    Session::put('selected_theme', 'theme_one');
                } elseif ($theme == 2) {
                    Session::put('selected_theme', 'theme_two');
                } elseif ($theme == 3) {
                    Session::put('selected_theme', 'theme_three');
                } else {
                    if (!Session::has('selected_theme')) {
                        Session::put('selected_theme', 'theme_one');
                    }
                }
            } else {
                Session::put('selected_theme', 'theme_one');
            }
        } else {
            if ($setting->value == 1) {
                Session::put('selected_theme', 'theme_one');
            } elseif ($setting->value == 2) {
                Session::put('selected_theme', 'theme_two');
            } elseif ($setting->value == 3) {
                Session::put('selected_theme', 'theme_three');
            }
        }
    }
}

if (!function_exists('getActiveThemeLayout')) {
    function getActiveThemeLayout(): string
    {
        setTheme();

        $selectedTheme = Session::get('selected_theme', 'theme_one');

        return match ($selectedTheme) {
            'theme_one' => 'website.layout',
            'theme_two' => 'website.layout2',
            'theme_three' => 'website.layout3',
            default => 'website.layout',
        };
    }
}

if (!function_exists('isRoute')) {
    /**
     * @param array  $route
     * @param string $returnValue
     */
    function isRoute(string | array $route, string $returnValue = null)
    {
        if (is_array($route)) {
            foreach ($route as $value) {
                if (Route::is($value)) {
                    return is_null($returnValue) ? true : $returnValue;
                }
            }

            return false;
        }

        if (Route::is($route)) {
            return is_null($returnValue) ? true : $returnValue;
        }

        return false;
    }
}

if (!function_exists('isUrlSame')) {
    /**
     * @param array    $url
     * @param string   $returnValue
     * @param nullbool $full
     */
    function isUrlSame(string | array $url, string $returnValue = null, bool $full = false)
    {
        $currentUrl = $full ? request()->fullUrl() : url()->current();

        if (is_array($url)) {
            foreach ($url as $value) {
                if ($currentUrl == url($value)) {
                    return is_null($returnValue) ? true : $returnValue;
                }
            }

            return false;
        }

        return ($currentUrl == url($url)) ? (is_null($returnValue) ? true : $returnValue) : false;
    }
}

if (!function_exists('settingCache')) {
    /**
     * @return mixed
     */
    function settingCache()
    {
        return Cache::rememberForever('setting', function () {
            $setting_info = Setting::all();
            $setting      = [];
            foreach ($setting_info as $setting_item) {
                $setting[$setting_item->key] = $setting_item->value;
            }

            $setting = (object) $setting;

            return $setting;
        });
    }
}

if (!function_exists('googleRecaptchaObject')) {

    function googleRecaptchaObject()
    {
        $setting = cache()->has('setting') ? cache()->get('setting') : settingCache();

        return (object) [
            'site_key'   => $setting->recaptcha_site_key,
            'secret_key' => $setting->recaptcha_secret_key,
            'status'     => $setting->recaptcha_status,
        ];
    }
}

if (!function_exists('getTranslationLangCode')) {

    /**
     * @return string
     */
    function getTranslationLangCode(): string
    {
        return (string) request()->hasHeader('Language-Code') ? request()->header('Language-Code', 'en') : getSessionLanguage();
    }
}

if (!function_exists('getApiCurrencyCode')) {

    /**
     * @return string | MultiCurrency
     */
    function getApiCurrencyCode(bool $isCurrencyInstance = false): string | MultiCurrency
    {
        $currency = (string) request()->hasHeader('Currency-Code') ? request()->header('Currency-Code', 'en') : MultiCurrency::where('is_default', 'yes')->first()->currency_code;

        return $isCurrencyInstance ? MultiCurrency::where('currency_code', getSessionCurrency())->first() : $currency;
    }
}

if (!function_exists('getApiCurrencyIcon')) {

    /**
     * @return string | MultiCurrency
     */
    function getApiCurrencyIcon(): string
    {
        return getApiCurrencyCode(true)->currency_icon;
    }
}

if (!function_exists('convertToCurrencyAmount')) {

    /**
     * @param  $amount
     * @return float
     */
    function convertToCurrencyAmount($amount): float | string
    {
        $currencyCode = getApiCurrencyCode();

        $currency = allCurrencies()->where('currency_code', $currencyCode)->first();

        $currencyRate = $currency->currency_rate;

        $calculate = round(floatval($amount) * floatval($currencyRate), 2);

        return $currency->currency_position == 'before' ? $currency->currency_icon . $calculate : $calculate . $currency->currency_icon;
    }
}

if (!function_exists('removeImageBackground')) {
    /**
     * Remove background from image using color-based removal
     * 
     * @param string $imagePath Full path to the image file (relative to public or absolute)
     * @param string $backgroundColor Color to remove (hex format, default: #FFFFFF for white)
     * @param int $tolerance Color matching tolerance (0-100, default: 10)
     * @param bool $backupOriginal Whether to backup original file (default: true)
     * @return string|false Returns new file path on success, false on failure
     */
    function removeImageBackground(string $imagePath, string $backgroundColor = '#FFFFFF', int $tolerance = 10, bool $backupOriginal = true): string | false
    {
        try {
            // Handle relative paths (from public directory)
            $fullPath = str_starts_with($imagePath, '/') || str_starts_with($imagePath, public_path()) 
                ? $imagePath 
                : public_path($imagePath);
            
            if (!File::exists($fullPath)) {
                Log::error("Image file not found: {$fullPath}");
                return false;
            }

            // Check if GD extension is available
            if (!extension_loaded('gd')) {
                Log::error("GD extension is not loaded");
                return false;
            }

            // Create backup if requested
            if ($backupOriginal) {
                $backupPath = $fullPath . '.backup.' . date('Y-m-d-His') . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
                File::copy($fullPath, $backupPath);
            }

            // Get image info
            $imageInfo = getimagesize($fullPath);
            if ($imageInfo === false) {
                Log::error("Invalid image file: {$fullPath}");
                return false;
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $mimeType = $imageInfo['mime'];

            // Create image resource based on type
            switch ($mimeType) {
                case 'image/jpeg':
                case 'image/jpg':
                    $sourceImage = imagecreatefromjpeg($fullPath);
                    break;
                case 'image/png':
                    $sourceImage = imagecreatefrompng($fullPath);
                    break;
                case 'image/webp':
                    $sourceImage = imagecreatefromwebp($fullPath);
                    break;
                case 'image/gif':
                    $sourceImage = imagecreatefromgif($fullPath);
                    break;
                default:
                    Log::error("Unsupported image type: {$mimeType}");
                    return false;
            }

            if ($sourceImage === false) {
                Log::error("Failed to create image resource from: {$fullPath}");
                return false;
            }

            // Create new image with transparency support
            $newImage = imagecreatetruecolor($width, $height);
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            
            // Fill with transparent background
            $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
            imagefill($newImage, 0, 0, $transparent);

            // Convert hex color to RGB
            $bgColor = hex2rgb($backgroundColor);
            $targetR = $bgColor['r'];
            $targetG = $bgColor['g'];
            $targetB = $bgColor['b'];

            // Calculate tolerance value (0-255 range)
            $toleranceValue = ($tolerance / 100) * 255;

            // Process each pixel
            for ($x = 0; $x < $width; $x++) {
                for ($y = 0; $y < $height; $y++) {
                    $rgb = imagecolorat($sourceImage, $x, $y);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    
                    // Extract alpha channel (for PNG images)
                    $a = 127; // Default to opaque
                    if ($mimeType === 'image/png') {
                        $a = ($rgb >> 24) & 0x7F;
                    }

                    // Calculate color distance
                    $distance = sqrt(
                        pow($r - $targetR, 2) +
                        pow($g - $targetG, 2) +
                        pow($b - $targetB, 2)
                    );

                    // If pixel color is within tolerance, make it transparent
                    if ($distance <= $toleranceValue) {
                        // Make transparent
                        imagesetpixel($newImage, $x, $y, $transparent);
                    } else {
                        // Copy pixel, preserve existing transparency if any
                        $alpha = ($a < 127) ? $a : 0; // Keep existing alpha or make opaque
                        $color = imagecolorallocatealpha($newImage, $r, $g, $b, $alpha);
                        imagesetpixel($newImage, $x, $y, $color);
                    }
                }
            }

            // Convert to PNG format to support transparency
            $pathInfo = pathinfo($fullPath);
            $newPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.png';
            
            // Save as PNG
            $result = imagepng($newImage, $newPath);
            
            // Clean up
            imagedestroy($sourceImage);
            imagedestroy($newImage);

            if (!$result) {
                Log::error("Failed to save processed image to: {$newPath}");
                return false;
            }

            // If new file is different from original, delete original
            if ($newPath !== $fullPath && File::exists($fullPath)) {
                File::delete($fullPath);
            }

            // Return relative path if original was relative
            if (!str_starts_with($imagePath, '/') && !str_starts_with($imagePath, public_path())) {
                $newPath = str_replace(public_path() . '/', '', $newPath);
            }

            return $newPath;
            
        } catch (\Exception $e) {
            Log::error("Error removing image background: " . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('hex2rgb')) {
    /**
     * Convert hex color to RGB array
     * 
     * @param string $hex Hex color code (with or without #)
     * @return array Array with 'r', 'g', 'b' keys
     */
    function hex2rgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        
        // Handle 3-digit hex
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        
        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }
}
