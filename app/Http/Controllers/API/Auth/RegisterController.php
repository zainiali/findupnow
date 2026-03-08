<?php

namespace App\Http\Controllers\API\Auth;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\BreadcrumbImage;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\SocialLoginInformation;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:api');
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
     * @param Request $request
     */
    public function storeRegister(Request $request)
    {
        $rules = [
            'name'                 => 'required',
            'email'                => 'required|unique:users',
            'password'             => 'required|min:4',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'name.required'      => __('Name is required'),
            'email.required'     => __('Email is required'),
            'email.unique'       => __('Email already exist'),
            'password.required'  => __('Password is required'),
            'password.min'       => __('Password must be 4 characters'),
            'password.confirmed' => __('Confirm password does not match'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user                        = new User();
        $user->name                  = $request->name;
        $user->email                 = $request->email;
        $user->password              = Hash::make($request->password);
        $user->otp_mail_verify_token = random_int(100000, 999999);
        $user->status                = 1;
        $user->save();

        MailHelper::setMailConfig();

        $template = EmailTemplate::where('id', 10)->first();
        $subject  = $template->subject;
        $message  = $template->message;
        $message  = str_replace('{{user_name}}', $request->name, $message);
        $message .= '<br><h3>' . $user->otp_mail_verify_token . '</h3>';

        MailSender::sendMail($user->email, $subject, $message);

        $notification = __('Register Successfully. Please Verify your email');
        return response()->json(['message' => $notification]);
    }

    /**
     * @param Request $request
     */
    public function resendRegisterCode(Request $request)
    {
        $rules = [
            'email' => 'required',
        ];
        $customMessages = [
            'email.required' => __('Email is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->email_verified == 0) {
                MailHelper::setMailConfig();

                $template = EmailTemplate::where('id', 10)->first();
                $subject  = $template->subject;
                $message  = $template->message;
                $message  = str_replace('{{user_name}}', $user->name, $message);
                $message .= '<br><h3>' . $user->otp_mail_verify_token . '</h3>';

                MailSender::sendMail($user->email, $subject, $message);

                $notification = __('Register Successfully. Please Verify your email');
                return response()->json(['notification' => $notification]);

            } else {
                $notification = __('Already verified your account');
                return response()->json(['notification' => $notification], 403);
            }
        } else {
            $notification = __('Email does not exist');
            return response()->json(['notification' => $notification], 403);
        }

    }

    /**
     * @param $token
     */
    public function userVerification($token)
    {
        $user = User::where('otp_mail_verify_token', $token)->first();
        if ($user) {
            $user->otp_mail_verify_token = null;
            $user->status                = 1;
            $user->email_verified        = 1;
            $user->save();
            $notification = __('Verification Successfully');
            return response()->json(['message' => $notification]);
        } else {
            $notification = __('Invalid token');
            return response()->json(['message' => $notification], 403);
        }
    }

    /**
     * @param array $data
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param array $data
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
