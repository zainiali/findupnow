<?php

namespace App\Http\Controllers\API\Auth;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BreadcrumbImage;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\SocialLoginInformation;
use App\Models\User;
use App\Rules\Captcha;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:api')->except('userLogout');
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

        return response()->json([
            'breadcrumb'       => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'socialLogin'      => $socialLogin,
            'login_page'       => $login_page,
        ]);
    }

    /**
     * @param  Request $request
     * @return mixed
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

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credential = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status == 1) {
                if ($user->is_provider == 1) {
                    if (!$request->login_as_a_provider) {
                        $notification = __('You are a provider, you can not login here');
                        return response()->json(['message' => $notification], 403);
                    }
                }
                if (Hash::check($request->password, $user->password)) {

                    // set JWT TTL to 6 months
                    JWTAuth::factory()->setTTL(259200);

                    if (!$token = Auth::guard('api')->attempt($credential)) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }

                    $user = User::where('email', $request->email)->select('id', 'name', 'email', 'phone', 'image', 'status')->first();
                    return $this->respondWithToken($token, $user);

                } else {
                    $notification = __('Credentials does not exist');
                    return response()->json(['message' => $notification], 403);
                }

            } else {
                $notification = __('Disabled Account');
                return response()->json(['message' => $notification], 403);
            }
        } else {
            $notification = __('Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    /**
     * @param $token
     * @param $user
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->guard('api')->factory()->getTTL(),
            'user'         => UserResource::make($user),
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }

    public function forgetPage()
    {
        $breadcrumb       = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = googleRecaptchaObject();

        return response()->json([
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

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->forget_password_otp = random_int(100000, 999999);
            $user->save();

            MailHelper::setMailConfig();

            $template = EmailTemplate::where('id', 11)->first();
            $subject  = $template->subject;
            $message  = $template->message;
            $message  = str_replace('{{name}}', $user->name, $message);

            $message .= '<br><h3>' . $user->forget_password_otp . '</h3>';

            MailSender::sendMail($user->email, $subject, $message);

            $notification = __('Reset password link send to your email.');
            return response()->json(['message' => $notification]);

        } else {
            $notification = __('Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    /**
     * @param $token
     */
    public function resetPasswordPage($token)
    {
        $user             = User::where('forget_password_token', $token)->first();
        $breadcrumb       = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = googleRecaptchaObject();

        return response()->json([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'user'             => UserResource::make($user),
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

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where(['email' => $request->email, 'forget_password_otp' => $token])->first();
        if ($user) {
            $user->password            = Hash::make($request->password);
            $user->forget_password_otp = null;
            $user->save();

            $notification = __('Password Reset successfully');
            return response()->json(['notification' => $notification], 200);
        } else {
            $notification = __('Email or token does not exist');
            return response()->json(['notification' => $notification], 403);
        }
    }

    public function userLogout()
    {
        Auth::guard('api')->logout();
        $notification = __('Logout Successfully');
        return response()->json([
            'message' => $notification,
        ]);

    }

    public function redirectToGoogle()
    {
        $googleInfo = SocialLoginInformation::first();

        return response()->json([
            'status'    => $googleInfo->is_gmail,
            'client_id' => $googleInfo->gmail_client_id,
            'redirect'  => $googleInfo->gmail_redirect_url, // note: but i think we need to send callback for api?
        ]);
    }

    /**
     * @return mixed
     */
    public function googleCallBack(Request $request)
    {
        $facebookInfo = SocialLoginInformation::first();
        if ($facebookInfo) {
            Config::set('services.facebook.client_id', $facebookInfo->gmail_client_id);
            Config::set('services.facebook.client_secret', $facebookInfo->gmail_secret_id);
            Config::set('services.facebook.redirect', $facebookInfo->gmail_redirect_url);
        }

        try {
            $accessToken  = $request->get('access_token');
            $provider     = $request->get('provider');
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }

        if (filled($providerUser)) {
            $user = $this->createUser($providerUser, $provider);
        } else {
            $user = $providerUser;
        }

        $token = Auth::guard('api')->login($user);

        if (auth('api')->check() && $token) {
            return $this->respondWithToken($token, $user);
        } else {
            return $this->error(
                message: 'Failed to Login try again',
                code: 401
            );
        }
    }

    public function redirectToFacebook()
    {
        $facebookInfo = SocialLoginInformation::first();

        return response()->json([
            'status'    => $facebookInfo->is_facebook,
            'client_id' => $facebookInfo->facebook_client_id,
            'redirect'  => $facebookInfo->facebook_redirect_url, // note: but i think we need to send callback for api?
        ]);
    }

    /**
     * @param Request $request
     */
    public function facebookCallBack(Request $request)
    {
        $facebookInfo = SocialLoginInformation::first();

        if ($facebookInfo) {
            Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            Config::set('services.facebook.redirect', $facebookInfo->facebook_redirect_url);
        }

        try {
            $accessToken  = $request->get('access_token');
            $provider     = $request->get('provider');
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }

        if (filled($providerUser)) {
            $user = $this->createUser($providerUser, $provider);
        } else {
            $user = $providerUser;
        }

        $token = Auth::guard('api')->login($user);

        if (auth('api')->check() && $token) {
            return $this->respondWithToken($token, $user);
        } else {
            return $this->error(
                message: 'Failed to Login try again',
                code: 401
            );
        }
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
