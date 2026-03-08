<?php

namespace App\Http\Controllers\Auth;

use App\Facades\MailSender;
use App\Http\Controllers\Controller;
use App\Models\BreadcrumbImage;
use App\Models\Setting;
use App\Models\SocialLoginInformation;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\JobPost\Entities\JobPost;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:web');
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

        return view('website.register')->with([
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
    public function storeRegister(Request $request)
    {
        // Check if OTP is verified
        if (!Session::get('quote_otp_verified')) {
            $notification = __('Please verify your phone number with OTP first');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }

        $rules = [
            'name'                 => 'required|string|max:255',
            'email'                => 'required|email|unique:users',
            'phone'                => 'required|string|max:20',
            'address'              => 'required|string|max:500',
            'category_id'          => 'required|exists:categories,id',
            'timeline'             => 'required|in:immediate,1_month,3_months',
            'licensed'             => 'required|in:yes,no',
            'insured'              => 'required|in:yes,no',
            'permit_required'      => 'required|in:yes,no',
            'description'          => 'nullable|string|max:2000',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'name.required'         => __('Name is required'),
            'email.required'        => __('Email is required'),
            'email.email'           => __('Please enter a valid email address'),
            'email.unique'          => __('Email already exists'),
            'phone.required'        => __('Phone number is required'),
            'address.required'      => __('Address is required'),
            'category_id.required'   => __('Please select a project category'),
            'category_id.exists'    => __('Selected category is invalid'),
            'timeline.required'     => __('Please select a timeline'),
            'timeline.in'           => __('Invalid timeline selected'),
            'licensed.required'     => __('Please specify if licensed is required'),
            'insured.required'      => __('Please specify if insured is required'),
            'permit_required.required' => __('Please specify if permit is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        // Generate a random password for the user (they can change it later)
        $password = Str::random(12);

        // Create user account
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->password     = Hash::make($password);
        $user->verify_token = Str::random(100);
        $user->status       = 1;
        $user->email_verified = 1; // Auto-verify email
        $user->is_provider  = 0; // Client/Customer
        $user->save();

        // Send welcome email with password
        MailSender::afterRegistrationMail($user, $user->name);

        // Create project (JobPost)
        $jobPost = $this->createProject($user, $request);

        // Clear OTP session
        Session::forget('quote_otp_verified');
        Session::forget('quote_otp');
        Session::forget('quote_otp_contact');
        Session::forget('quote_otp_type');
        Session::forget('quote_otp_expires_at');

        // Auto-login the user after registration
        Auth::guard('web')->login($user);

        // Send notifications to nearby providers (if needed)
        $this->notifyNearbyProviders($jobPost);

        $notification = __('Account created and project posted successfully!');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Create a project (JobPost) for the user
     */
    private function createProject(User $user, Request $request)
    {
        // Map timeline to job urgency
        $isUrgent = 'disable';
        if ($request->timeline === 'immediate') {
            $isUrgent = 'enable';
        }

        // Create project title based on category
        $category = \App\Models\Category::find($request->category_id);
        $title = $category ? $category->name . ' Project' : 'New Project';

        // Create slug
        $slug = Str::slug($title . '-' . $user->id . '-' . time());

        // Build project description with requirements
        $description = $request->description ?? '';
        $description .= "\n\nProject Requirements:\n";
        $description .= "- Licensed Required: " . ucfirst($request->licensed) . "\n";
        $description .= "- Insured Required: " . ucfirst($request->insured) . "\n";
        $description .= "- Permit Required: " . ucfirst($request->permit_required) . "\n";
        $description .= "- Timeline: " . ucfirst(str_replace('_', ' ', $request->timeline));

        // Get default city (you may want to extract from address or use a default)
        $cityId = 1; // Default city, you can enhance this to extract from address

        $jobPost = new JobPost();
        $jobPost->user_id           = $user->id;
        $jobPost->category_id       = $request->category_id;
        $jobPost->city_id           = $cityId;
        $jobPost->slug              = $slug;
        $jobPost->title             = $title;
        $jobPost->description       = $description;
        $jobPost->address           = $request->address;
        $jobPost->regular_price     = 0; // Can be set later
        $jobPost->job_type          = 'project';
        $jobPost->is_urgent         = $isUrgent;
        $jobPost->status            = 'enable';
        $jobPost->approved_by_admin = 'approved'; // Auto-approve for registered clients
        // Use category image as default, or a placeholder
        $category = \App\Models\Category::find($request->category_id);
        if ($category && $category->image) {
            $jobPost->thumb_image = $category->image;
        } else {
            // Use a default placeholder image path
            $jobPost->thumb_image = 'uploads/default-project-image.jpg';
        }
        $jobPost->save();

        return $jobPost;
    }

    /**
     * Notify nearby providers about the new project
     */
    private function notifyNearbyProviders(JobPost $jobPost)
    {
        // Find providers in the same category and city
        $providers = User::where('is_provider', 1)
            ->where('status', 1)
            ->whereHas('services', function($query) use ($jobPost) {
                $query->where('category_id', $jobPost->category_id)
                      ->where('status', 1)
                      ->where('approve_by_admin', 1);
            })
            ->get();

        // Here you can implement push notification logic
        // For now, we'll just log it (you can integrate with your notification system)
        \Log::info('New project posted', [
            'project_id' => $jobPost->id,
            'providers_count' => $providers->count()
        ]);

        // TODO: Implement actual push notification sending
        // You can use Laravel notifications, Pusher, or any other service
    }

    /**
     * @param $token
     */
    public function userVerification($token)
    {
        $user = User::where('verify_token', $token)->first();
        if ($user) {
            $user->verify_token   = null;
            $user->status         = 1;
            $user->email_verified = 1;
            $user->save();
            $notification = __('Verification Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('login')->with($notification);
        } else {
            $notification = __('Invalid token');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
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
