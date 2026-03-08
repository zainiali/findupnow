<?php

namespace App\Http\Controllers\Auth;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\BreadcrumbImage;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\SocialLoginInformation;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
    }

    public function loginPage()
    {
        $breadcrumb       = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = googleRecaptchaObject();
        $socialLogin      = SocialLoginInformation::first();

        $setting    = Setting::first();
        $login_page = [
            'image' => $setting->login_image,
        ];
        $login_page = (object) $login_page;

        return view('website.login')->with([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'socialLogin'      => $socialLogin,
            'login_page'       => $login_page,
        ]);
    }

    /**
     * @param Request $request
     */
    public function storeLogin(Request $request)
    {
        $rules = [
            'email'                => 'required',
            'password'             => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'email.required'    => __('Email is required'),
            'password.required' => __('Password is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $credential = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status == 1) {
                if (Hash::check($request->password, $user->password)) {
                    if (Auth::guard('web')->attempt($credential, $request->remember)) {
                        $notification = __('Login Successfully');
                        $notification = ['message' => $notification, 'alert-type' => 'success'];
                        if ($user->is_provider == 1) {
                            return redirect()->route('provider.dashboard')->with($notification);
                        } else {
                            return redirect()->intended(route('dashboard'))->with($notification);
                        }

                    }
                } else {
                    $notification = __('Credentials does not exist');
                    $notification = ['message' => $notification, 'alert-type' => 'error'];
                    return redirect()->back()->with($notification);
                }

            } else {
                $notification = __('Disabled Account');
                $notification = ['message' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = __('Email does not exist');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function forgetPage()
    {
        $breadcrumb       = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = googleRecaptchaObject();

        return view('website.forget_password')->with([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    /**
     * @param Request $request
     */
    public function sendForgetPassword(Request $request)
    {
        $rules = [
            'email'                => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'email.required' => __('Email is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->forget_password_token = Str::random(100);
            $user->save();

            MailHelper::setMailConfig();
            $template = EmailTemplate::where('id', 1)->first();
            $subject  = $template->subject;
            $message  = $template->message;
            $message  = str_replace('{{name}}', $user->name, $message);

            MailSender::sendMail($user->email, $subject, $message, [
                __('Reset Password') => route('reset-password', $user->forget_password_token),
            ]);

            $notification = __('Reset password link send to your email.');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

        } else {
            $notification = __('Email does not exist');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param $token
     */
    public function resetPasswordPage($token)
    {
        $user             = User::select('id', 'name', 'email', 'forget_password_token')->where('forget_password_token', $token)->first();
        $breadcrumb       = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = googleRecaptchaObject();

        return view('website.reset_password')->with([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'user'             => $user,
            'token'            => $token,
        ]);
    }

    /**
     * @param Request  $request
     * @param $token
     */
    public function storeResetPasswordPage(Request $request, $token)
    {
        $rules = [
            'email'                => 'required',
            'password'             => 'required|min:4|confirmed',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'email.required'     => __('Email is required'),
            'password.required'  => __('Password is required'),
            'password.min'       => __('Password must be 4 characters'),
            'password.confirmed' => __('Confirm password does not match'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::where(['email' => $request->email, 'forget_password_token' => $token])->first();
        if ($user) {
            $user->password              = Hash::make($request->password);
            $user->forget_password_token = null;
            $user->save();

            $notification = __('Password Reset successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('login')->with($notification);
        } else {
            $notification = __('Something went wrong');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
        }
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        $notification = __('Logout Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('login')->with($notification);
    }

    public function redirectToGoogle()
    {
        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', route('callback-google'));

        return Socialite::driver('google')->redirect();
    }

    public function googleCallBack()
    {

        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', route('callback-google'));

        $user = Socialite::driver('google')->user();
        $user = $this->createUser($user, 'google');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }

    public function redirectToFacebook()
    {

        $facebookInfo = SocialLoginInformation::first();
        if ($facebookInfo) {
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', route('callback-facebook'));
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallBack()
    {
        $facebookInfo = SocialLoginInformation::first();
        if ($facebookInfo) {
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', route('callback-facebook'));
        }

        $user = Socialite::driver('facebook')->user();
        $user = $this->createUser($user, 'facebook');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }

    /**
     * @param  $getInfo
     * @param  $provider
     * @return mixed
     */
    public function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'            => $getInfo->name,
                'email'           => $getInfo->email,
                'provider'        => $provider,
                'provider_id'     => $getInfo->id,
                'provider_avatar' => $getInfo->avatar,
                'status'          => 1,
                'email_verified'  => 1,
            ]);
        }
        return $user;
    }
}
