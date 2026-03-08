<?php

namespace App\Http\Controllers\API;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\AboutUs;
use App\Models\AppointmentSchedule;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BreadcrumbImage;
use App\Models\Category;
use App\Models\City;
use App\Models\ContactMessage;
use App\Models\ContactPage;
use App\Models\Counter;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\CustomPagination;
use App\Models\EmailTemplate;
use App\Models\FacebookComment;
use App\Models\Faq;
use App\Models\HowItWork;
use App\Models\MobileSlider;
use App\Models\Order;
use App\Models\Partner;
use App\Models\PopularPost;
use App\Models\Review;
use App\Models\SectionContent;
use App\Models\SectionControl;
use App\Models\SeoSetting;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TermsAndCondition;
use App\Models\Testimonial;
use App\Models\User;
use App\Rules\Captcha;
use App\Traits\GetGlobalInformationTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use JsonException;
use Modules\GlobalSetting\app\Models\Setting as GlobalSetting;
use Modules\NewsLetter\app\Models\NewsLetter;
use Modules\PageBuilder\app\Models\CustomizeablePage;

class HomeController extends Controller
{
    use GetGlobalInformationTrait;

    public function allLanguages()
    {
        return response()->json([
            'data'   => allLanguages()->where('status', 1),
            'status' => 'success',
        ]);
    }

    /**
     * @return mixed
     */
    public function currentLanguageDetails()
    {
        if (request()->hasHeader('Language-Code')) {
            $code = request()->header('Language-Code');
        } else {
            $code = allLanguages()->where('is_default', 1)->first()->code;
        }

        return response()->json([
            'data'   => allLanguages()->where('code', $code)->first(),
            'status' => 'success',
        ]);
    }

    public function allCurrencies()
    {
        return response()->json([
            'data'   => allCurrencies()->select('currency_name', 'country_code', 'currency_code', 'currency_icon', 'is_default', 'currency_rate', 'currency_position', 'status')->where('status', 'active'),
            'status' => 'success',
        ]);
    }

    public function currentCurrencyDetails()
    {
        if (request()->hasHeader('Currency-Code')) {
            $code = request()->header('Currency-Code');
        } else {
            $code = allCurrencies()->where('is_default', 'yes')->first()->currency_code;
        }

        return response()->json([
            'data'   => allCurrencies()->where('currency_code', $code)->first(),
            'status' => 'success',
        ]);
    }

    /**
     * @return mixed
     */
    public function websiteSetup()
    {
        $setting_info = GlobalSetting::all();
        $setting      = [];
        foreach ($setting_info as $setting_item) {
            $setting[$setting_item->key] = $setting_item->value;
        }

        $setting = (object) $setting;

        $pusher_credentail = (object) [
            'pusher_app_id'      => $setting->pusher_app_id,
            'pusher_app_key'     => $setting->pusher_app_key,
            'pusher_app_secret'  => $setting->pusher_app_secret,
            'pusher_app_cluster' => $setting->pusher_app_cluster,
            'pusher_status'      => $setting->pusher_status,
        ];

        return response()->json([
            'pusher_credentail' => $pusher_credentail,
            'setting'           => $setting,
        ]);
    }
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $contents    = SectionContent::all();
        $control     = SectionControl::get();
        $setting     = Setting::first();
        $seo_setting = SeoSetting::where('id', 1)->first();

        // intro section start

        $intro_visibility = false;
        $intro            = $control->where('id', 1)->first();
        if ($intro->status == 1) {
            $intro_visibility = true;
        }

        $intro_section = Slider::with('translation')->first();

        $service_areas  = City::orderBy('name', 'asc')->where('status', 1)->get();
        $popular_tag    = json_decode($intro_section->popular_tag);
        $mobile_sliders = MobileSlider::OrderBy('serial', 'asc')->get();
        // intro section end

        // category section start

        $category_control    = $control->where('id', 2)->first();
        $category_visibility = false;
        if ($category_control->status == 1) {
            $category_visibility = true;
        }

        $category_content = $contents->where('id', 1)->first();
        $category_section = (object) [
            'visibility'  => $category_visibility,
            'title'       => $category_content->title,
            'description' => $category_content->description,
        ];

        $search_categories = Category::orderBy('slug', 'asc')->where('status', 1)->get();
        // Show all active categories (remove limit)
        $categories = Category::orderBy('slug', 'asc')->where('status', 1)->get();

        // category section end

        // featured section start

        $featured_control            = $control->where('id', 3)->first();
        $featured_section_visibility = false;
        if ($featured_control->status == 1) {
            $featured_section_visibility = true;
        }

        $featured_service_content = $contents->where('id', 2)->first();
        $featured_service_section = (object) [
            'visibility'  => $featured_section_visibility,
            'title'       => $featured_service_content->title,
            'description' => $featured_service_content->description,
        ];

        $featured_services = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->orderBy('id', 'desc')->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'make_featured', 'is_banned', 'status', 'approve_by_admin')->get();

        // featured section end

        // coundown section start

        $coundown_visibility = false;
        $coundown_control    = $control->where('id', 4)->first();
        if ($coundown_control->status == 1) {
            $coundown_visibility = true;
        }

        $counters = Counter::with('translation')->where('status', 1)->get()->take($coundown_control->qty);

        $counter_bg_image = ['image' => $setting->counter_bg_image];
        $counter_bg_image = (object) $counter_bg_image;

        // coundown section end

        // popular section start

        $popular_control            = $control->where('id', 5)->first();
        $popular_section_visibility = false;
        if ($popular_control->status == 1) {
            $popular_section_visibility = true;
        }

        $popular_service_content = $contents->where('id', 3)->first();
        $popular_service_section = (object) [
            'visibility'  => $popular_section_visibility,
            'title'       => $popular_service_content->title,
            'description' => $popular_service_content->description,
        ];

        $popular_services = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->orderBy('id', 'desc')->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'make_popular', 'is_banned', 'status', 'approve_by_admin')->get();

        // popular section end

        $currency_icon = ['icon' => getApiCurrencyIcon()];
        $currency_icon = (object) $currency_icon;

        // join as provider section start

        $join_as_provider_visibility = false;
        $provider_control            = $control->where('id', 6)->first();
        if ($provider_control->status == 1) {
            $join_as_provider_visibility = true;
        }

        $join_as_a_provider = [
            'image'       => $setting->join_as_a_provider_banner,
            'home2_image' => $setting->home2_join_as_provider,
            'home3_image' => $setting->home3_join_as_provider,
            'title'       => $setting->join_as_a_provider_title,
            'button_text' => $setting->join_as_a_provider_btn,
        ];
        $join_as_a_provider = (object) $join_as_a_provider;

        // join as provider section end

        //mobile section start

        $mobile_app_section_visbility = false;
        $app_control                  = $control->where('id', 7)->first();
        if ($app_control->status == 1) {
            $mobile_app_section_visbility = true;
        }

        $mobile_app = [
            'short_title'     => $setting->app_short_title,
            'full_title'      => $setting->app_full_title,
            'description'     => $setting->app_description,
            'play_store'      => $setting->google_playstore_link,
            'app_store'       => $setting->app_store_link,
            'image'           => $setting->app_image,
            'home2_app_image' => $setting->home2_app_image,
            'home3_app_image' => $setting->home3_app_image,
        ];
        $mobile_app = (object) $mobile_app;

        // mobile  section end

        // testimonial section start
        $testimonial_control    = $control->where('id', 8)->first();
        $testimonial_visibility = false;
        if ($testimonial_control->status == 1) {
            $testimonial_visibility = true;
        }

        $testimonial_content = $contents->where('id', 4)->first();
        $testimonial_section = (object) [
            'visibility'  => $testimonial_visibility,
            'title'       => $testimonial_content->title,
            'description' => $testimonial_content->description,
        ];

        $testimonials = Testimonial::with('translation')->where('status', 1)->get()->take($testimonial_control->qty);

        // testimonial section end

        // blog section start

        $blog_control    = $control->where('id', 9)->first();
        $blog_visibility = false;
        if ($blog_control->status == 1) {
            $blog_visibility = true;
        }

        $blog_content = $contents->where('id', 5)->first();
        $blog_section = (object) [
            'visibility'  => $blog_visibility,
            'title'       => $blog_content->title,
            'description' => $blog_content->description,
        ];

        $blogs = Blog::select('id', 'title', 'image', 'slug', 'status', 'show_homepage')->where(['status' => 1, 'show_homepage' => 1])->orderBy('id', 'desc')->get()->take($blog_control->qty);

        // blog section end

        // subscribe section start

        $subscription_visbility = false;
        $subscription_control   = $control->where('id', 10)->first();
        if ($subscription_control->status == 1) {
            $subscription_visbility = true;
        }

        $subscriber = [
            'title'                  => $setting->subscriber_title,
            'description'            => $setting->subscriber_description,
            'foreground_image'       => $setting->subscriber_image,
            'background_image'       => $setting->subscription_bg,
            'home2_background_image' => $setting->home2_subscription_bg,
            'home3_background_image' => $setting->home3_subscription_bg,
        ];
        $subscriber = (object) $subscriber;

        // subscribe section end

        // partner start
        $partner_visbility = false;
        $partner_control   = $control->where('id', 22)->first();
        if ($partner_control->status == 1) {
            $partner_visbility = true;
        }

        $partners = Partner::where(['status' => 1])->get()->take($partner_control->qty);

        // parnter end

        // contact start

        $contact_visbility = false;
        $contact_control   = $control->where('id', 21)->first();
        if ($contact_control->status == 1) {
            $contact_visbility = true;
        }

        $contact = (object) [
            'foreground'       => $setting->home2_contact_foreground,
            'background'       => $setting->home2_contact_background,
            'call_as_now'      => $setting->home2_contact_call_as,
            'phone'            => $setting->home2_contact_phone,
            'available_time'   => $setting->home2_contact_available,
            'form_title'       => $setting->home2_contact_form_title,
            'form_description' => $setting->home2_contact_form_description,
        ];

        // contact end

        $recaptchaSetting = googleRecaptchaObject();

        // start how it work

        $work_visbility = false;
        $work_control   = $control->where('id', 33)->first();
        if ($work_control->status == 1) {
            $work_visbility = true;
        }

        $how_it_work = (object) [
            'background'  => $setting->how_it_work_background,
            'foreground'  => $setting->how_it_work_foreground,
            'title'       => $setting->how_it_work_title,
            'description' => $setting->how_it_work_description,
            'items'       => json_decode($setting->how_it_work_items),
        ];

        // end how it work

        return response()->json([
            'seo_setting'                  => $seo_setting,
            'intro_visibility'             => $intro_visibility,
            'intro_section'                => $intro_section,
            'mobile_sliders'               => $mobile_sliders,
            'popular_tag'                  => $popular_tag,
            'search_categories'            => $search_categories,
            'service_areas'                => $service_areas,
            'category_section'             => $category_section,
            'categories'                   => $categories,
            'featured_service_section'     => $featured_service_section,
            'featured_services'            => $featured_services,
            'currency_icon'                => $currency_icon,
            'contact_visbility'            => $contact_visbility,
            'contact_section'              => $contact,
            'recaptchaSetting'             => $recaptchaSetting,
            'coundown_visibility'          => $coundown_visibility,
            'counter_bg_image'             => $counter_bg_image,
            'counters'                     => $counters,
            'popular_service_section'      => $popular_service_section,
            'popular_services'             => $popular_services,
            'join_as_provider_visibility'  => $join_as_provider_visibility,
            'join_as_a_provider'           => $join_as_a_provider,
            'mobile_app_section_visbility' => $mobile_app_section_visbility,
            'mobile_app'                   => $mobile_app,
            'testimonial_section'          => $testimonial_section,
            'testimonials'                 => $testimonials,
            'blog_section'                 => $blog_section,
            'blogs'                        => $blogs,
            'subscription_visbility'       => $subscription_visbility,
            'subscriber'                   => $subscriber,
            'partner_visbility'            => $partner_visbility,
            'partners'                     => $partners,
        ]);
    }

    public function join_as_a_provider()
    {

        $breadcrumb       = BreadcrumbImage::where(['id' => 12])->first();
        $countries        = Country::where('status', 1)->orderBy('name', 'asc')->get();
        $recaptchaSetting = googleRecaptchaObject();

        return response()->json([
            'breadcrumb'       => $breadcrumb,
            'countries'        => $countries,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    /**
     * @param Request $request
     */
    public function checkUserName(Request $request)
    {

        $rules = [
            'username' => 'required',
        ];
        $customMessages = [
            'username.required' => __('Username is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::where('user_name', $request->username)->count();

        if ($user == 0) {
            return response()->json(['status' => 1, 'message' => __('Username available. you can use it')]);
        } else {
            return response()->json(['status' => 0, 'message' => __('User name already exist')], 403);
        }
    }

    /**
     * @param $id
     */
    public function stateByCountry($id)
    {

        $states = CountryState::where(['status' => 1, 'country_id' => $id])->orderBy('name', 'asc')->get();

        return response()->json(['states' => $states]);
    }

    /**
     * @param $id
     */
    public function cityByState($id)
    {
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->orderBy('name', 'asc')->get();

        return response()->json(['cities' => $cities]);
    }

    /**
     * @param Request $request
     */
    public function request_provider(Request $request)
    {
        $rules = [
            'name'                 => 'required',
            'user_name'            => 'required|unique:users,user_name',
            'email'                => 'required|email|unique:users,email',
            'phone'                => 'required',
            'designation'          => 'required',
            'country'              => 'required',
            'state'                => 'required',
            'service_area'         => 'required',
            'image'                => 'required|mimetypes:image/jpeg,image/pjpeg,image/png,image/gif,image/svg+xml,image/webp,image/avif,image/bmp,image/x-icon,image/vnd.microsoft.icon|max:2048',
            'address'              => 'required',
            'password'             => 'required|confirmed|min:4',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'name.required'         => __('Name is required'),
            'user_name.required'    => __('User name is required'),
            'user_name.unique'      => __('User name alreay exist'),
            'email.required'        => __('Email is required'),
            'email.unique'          => __('Email already exist'),
            'phone.required'        => __('Phone is required'),
            'country.required'      => __('Country or region is required'),
            'state.required'        => __('State or province is required'),
            'service_area.required' => __('Service area is required'),
            'designation.required'  => __('Desgination is required'),
            'address.required'      => __('Address is required'),
            'password.required'     => __('Password is required'),
            'password.min'          => __('Password must be 4 characters'),
            'password.confirmed'    => __('Confrim password does not match'),
            'image.required'        => __('Image is required'),
            'image.mimetypes'       => __('Image must be a file of type: jpeg, png, jpg, gif, svg, webp, avif, bmp, ico'),
            'image.max'             => __('Image may not be greater than 2MB'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->user_name    = $request->user_name;
        $user->phone        = $request->phone;
        $user->designation  = $request->designation;
        $user->address      = $request->address;
        $user->country_id   = $request->country;
        $user->state_id     = $request->state;
        $user->city_id      = $request->service_area;
        $user->is_provider  = 1;
        $user->password     = Hash::make($request->password);
        $user->verify_token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->status       = 1;
        $user->save();

        if ($request->hasFile('image')) {
            $user->image = saveFileGetPath($request->image);
            $user->save();
        }

        MailSender::afterRegistrationOTPMail($user, $request->name);

        $notification = __('Register Successfully. Please Verify your email');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    /**
     * @param $token
     */
    public function userOTPVerification($token)
    {
        $user = User::where('verify_token', $token)->first();
        if ($user) {
            $user->verify_token   = null;
            $user->status         = 1;
            $user->email_verified = 1;
            $user->save();
            $notification = __('Verification Successfully');
            return response()->json(['message' => $notification]);
        } else {
            $notification = __('Invalid token');
            return response()->json(['message' => $notification], 403);
        }
    }

    /**
     * @param Request $request
     */
    public function resendRegisterOTPCode(Request $request)
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
                MailSender::afterRegistrationOTPMail($user, $request->name);

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
     * @return mixed
     */
    public function aboutUs()
    {

        $contents = SectionContent::all();
        $control  = SectionControl::get();

        $seo_setting = SeoSetting::where('id', 2)->first();

        // start work section

        $work_visbility = false;
        $work_control   = $control->where('id', 35)->first();
        if ($work_control->status == 1) {
            $work_visbility = true;
        }

        $about                   = AboutUs::with('translation')->first()->append(['header', 'header_description']);
        $how_it_works            = HowItWork::with('translation')->get()->append(['title', 'description']);
        $how_it_work_title       = $about->header;
        $how_it_work_descritpion = $about->header_description;

        // work section end

        // about us start

        $about_visbility = false;
        $work_control    = $control->where('id', 36)->first();
        if ($work_control->status == 1) {
            $about_visbility = true;
        }

        $about_us_section = (object) [
            'about_us_title'     => $about->about_us_title,
            'about_us'           => $about->about_us,
            'foreground_image'   => $about->foreground_image,
            'background_image'   => $about->background_image,
            'client_image_one'   => $about->small_image_one,
            'client_image_two'   => $about->small_image_two,
            'client_image_three' => $about->small_image_three,
            'total_rating'       => $about->total_rating,
        ];

        // about us end

        // start why choose us

        $why_choose_visibility = false;
        $why_choose_control    = $control->where('id', 38)->first();
        if ($why_choose_control->status == 1) {
            $why_choose_visibility = true;
        }

        $why_choose_us = (object) [
            'why_choose_us_title'   => $about->why_choose_us_title,
            'why_choose_desciption' => $about->why_choose_desciption,
            'background_image'      => $about->why_choose_background,
            'foreground_image'      => $about->why_choose_foreground,
            'item_one'              => $about->title_one,
            'item_two'              => $about->title_two,
            'item_three'            => $about->title_three,
            'description_one'       => $about->description_one,
            'description_two'       => $about->description_two,
            'description_three'     => $about->description_three,
        ];

        // end why choose us

        $breadcrumb = BreadcrumbImage::where(['id' => 1])->first();

        // start coundwon
        $coundown_visibility = false;
        $coundown_control    = $control->where('id', 37)->first();
        if ($coundown_control->status == 1) {
            $coundown_visibility = true;
        }

        $counters = Counter::with('translation')->where('status', 1)->get()->take($coundown_control->qty);

        $setting          = Setting::first();
        $counter_bg_image = (object) ['image' => $setting->counter_bg_image];

        // end cowndown

        // start provider

        $join_as_provider_visibility = false;
        $provider_control            = $control->where('id', 39)->first();
        if ($provider_control->status == 1) {
            $join_as_provider_visibility = true;
        }

        $join_as_a_provider = (object) [
            'image'       => $setting->join_as_a_provider_banner,
            'title'       => $setting->join_as_a_provider_title,
            'button_text' => $setting->join_as_a_provider_btn,
        ];

        // end provider

        // testimonial section start
        $testimonial_control    = $control->where('id', 40)->first();
        $testimonial_visibility = false;
        if ($testimonial_control->status == 1) {
            $testimonial_visibility = true;
        }

        $testimonial_content = $contents->where('id', 4)->first();
        $testimonial_section = (object) [
            'visibility'  => $testimonial_visibility,
            'title'       => $testimonial_content->title,
            'description' => $testimonial_content->description,
        ];

        $testimonials = Testimonial::with('translation')->where('status', 1)->get()->take($testimonial_control->qty);

        // end testimonial

        return response()->json([
            'seo_setting'                 => $seo_setting,
            'breadcrumb'                  => $breadcrumb,
            'work_visbility'              => $work_visbility,
            'how_it_work_title'           => $how_it_work_title,
            'how_it_work_descritpion'     => $how_it_work_descritpion,
            'how_it_works'                => $how_it_works,
            'about_visbility'             => $about_visbility,
            'about_us_section'            => $about_us_section,
            'coundown_visibility'         => $coundown_visibility,
            'counters'                    => $counters,
            'counter_bg_image'            => $counter_bg_image,
            'why_choose_visibility'       => $why_choose_visibility,
            'why_choose_us'               => $why_choose_us,
            'join_as_provider_visibility' => $join_as_provider_visibility,
            'join_as_a_provider'          => $join_as_a_provider,
            'testimonial_section'         => $testimonial_section,
            'testimonials'                => $testimonials,
        ]);
    }

    public function contactUs()
    {
        $contact          = ContactPage::first();
        $breadcrumb       = BreadcrumbImage::where(['id' => 2])->first();
        $recaptchaSetting = googleRecaptchaObject();

        $seo_setting = SeoSetting::where('id', 3)->first();

        return response()->json([
            'seo_setting'      => $seo_setting,
            'breadcrumb'       => $breadcrumb,
            'contact'          => $contact,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    /**
     * @param Request $request
     */
    public function sendContactMessage(Request $request)
    {
        $rules = [
            'name'                 => 'required',
            'email'                => 'required',
            'subject'              => 'required',
            'message'              => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];

        $customMessages = [
            'name.required'    => __('Name is required'),
            'email.required'   => __('Email is required'),
            'subject.required' => __('Subject is required'),
            'message.required' => __('Message is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $setting = Setting::first();
        if ($setting->enable_save_contact_message == 1) {
            $contact          = new ContactMessage();
            $contact->name    = $request->name;
            $contact->email   = $request->email;
            $contact->subject = $request->subject;
            $contact->phone   = $request->phone;
            $contact->message = $request->message;
            $contact->save();
        }

        $template = EmailTemplate::where('id', 2)->first();
        $message  = $template->message;
        $subject  = $template->subject;
        $message  = str_replace('{{name}}', $request->name, $message);
        $message  = str_replace('{{email}}', $request->email, $message);
        $message  = str_replace('{{phone}}', $request->phone, $message);
        $message  = str_replace('{{subject}}', $request->subject, $message);
        $message  = str_replace('{{message}}', $request->message, $message);

        MailHelper::setMailConfig();
        MailSender::sendMail($setting->contact_email, $subject, $message);

        $notification = __('Message send successfully');
        return response()->json(['message' => $notification]);
    }

    /**
     * @param Request $request
     */
    public function blogs(Request $request)
    {
        $seo_setting = SeoSetting::where('id', 6)->first();

        $paginateQty = CustomPagination::whereId('1')->first()->qty;

        $blogs = Blog::select('id', 'title', 'image', 'slug', 'status')->where(['status' => 1])->orderBy('id', 'desc');

        if ($request->search) {
            $blogs = $blogs->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->category) {
            $category = BlogCategory::where('slug', $request->category)->first();
            $blogs    = $blogs->where('blog_category_id', $category->id);
        }
        $blogs = $blogs->paginate($paginateQty);

        $breadcrumb = BreadcrumbImage::where(['id' => 3])->first();

        $popularBlogs = PopularPost::select('id', 'blog_id', 'status')->where('status', 1)->get();

        $popular_arr = [];
        foreach ($popularBlogs as $popularBlog) {
            $popular_arr[] = $popularBlog->blog_id;
        }

        $popular_blogs = Blog::select('id', 'title', 'image', 'slug', 'status', 'created_at')->where(['status' => 1])->orderBy('id', 'desc')->whereIn('id', $popular_arr)->get()->take(6);

        $categories = BlogCategory::where(['status' => 1])->orderBy('name', 'asc')->get();

        $setting    = Setting::first();
        $subscriber = (object) [
            'title'       => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'image'       => $setting->blog_page_subscription_image,
        ];

        return response()->json([
            'seo_setting'   => $seo_setting,
            'breadcrumb'    => $breadcrumb,
            'blogs'         => $blogs,
            'popular_blogs' => $popular_blogs,
            'categories'    => $categories,
            'subscriber'    => $subscriber,
        ]);
    }

    /**
     * @param $slug
     */
    public function single_blog($slug)
    {

        $breadcrumb        = BreadcrumbImage::where(['id' => 3])->first();
        $blog              = Blog::with('category')->where('slug', $slug)->first();
        $blog_pagiante_qty = CustomPagination::whereId('4')->first()->qty;
        $blog_comments     = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->paginate($blog_pagiante_qty);

        $nextBlog = Blog::where('id', '>', $blog->id)->select('id', 'title', 'image', 'slug', 'status', 'created_at')->orderBy('id', 'asc')->where('status', 1)->first();
        $prevBlog = Blog::where('id', '<', $blog->id)->select('id', 'title', 'image', 'slug', 'status', 'created_at')->orderBy('id', 'desc')->where('status', 1)->first();

        $recaptchaSetting = googleRecaptchaObject();

        $popularBlogs = PopularPost::select('id', 'blog_id', 'status')->where('status', 1)->get();
        $popular_arr  = [];
        foreach ($popularBlogs as $popularBlog) {
            $popular_arr[] = $popularBlog->blog_id;
        }
        $popular_blogs = Blog::select('id', 'title', 'image', 'slug', 'status', 'created_at')->where(['status' => 1])->orderBy('id', 'desc')->whereIn('id', $popular_arr)->where('id', '!=', $blog->id)->get()->take(6);

        $categories = BlogCategory::where(['status' => 1])->orderBy('name', 'asc')->get();

        $setting    = Setting::first();
        $subscriber = (object) [
            'title'       => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'image'       => $setting->blog_page_subscription_image,
        ];

        $facebookComment = FacebookComment::first();

        return response()->json([
            'breadcrumb'       => $breadcrumb,
            'blog'             => $blog,
            'nextBlog'         => $nextBlog,
            'prevBlog'         => $prevBlog,
            'blog_comments'    => $blog_comments,
            'recaptchaSetting' => $recaptchaSetting,
            'popular_blogs'    => $popular_blogs,
            'categories'       => $categories,
            'subscriber'       => $subscriber,
            'facebookComment'  => $facebookComment,
        ]);
    }

    /**
     * @param Request $request
     */
    public function blogComment(Request $request)
    {
        $rules = [
            'name'                 => 'required',
            'email'                => 'required',
            'comment'              => 'required',
            'blog_id'              => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];

        $customMessages = [
            'name.required'    => __('Name is required'),
            'email.required'   => __('Email is required'),
            'comment.required' => __('Comment is required'),
            'blog_id.required' => __('Blog id is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $comment          = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->name    = $request->name;
        $comment->email   = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = __('Blog comment submited successfully');

        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function faq()
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 4])->first();

        $faqs = Faq::orderBy('id', 'desc')->where('status', 1)->get()->append(['question', 'answer']);

        $recaptchaSetting = googleRecaptchaObject();

        return response()->json([
            'breadcrumb'       => $breadcrumb,
            'faqs'             => $faqs,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    public function termsAndCondition()
    {
        $breadcrumb       = BreadcrumbImage::where(['id' => 5])->first();
        $terms_conditions = TermsAndCondition::first();
        $terms_conditions = $terms_conditions->terms_and_condition;

        return response()->json([
            'breadcrumb'       => $breadcrumb,
            'terms_conditions' => $terms_conditions,
        ]);
    }

    public function privacyPolicy()
    {
        $breadcrumb    = BreadcrumbImage::where(['id' => 6])->first();
        $privacyPolicy = TermsAndCondition::first();
        $privacyPolicy = $privacyPolicy->privacy_policy;

        return response()->json([
            'breadcrumb'    => $breadcrumb,
            'privacyPolicy' => $privacyPolicy,
        ]);
    }

    public function customPages()
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 7])->first();
        $pages      = CustomizeablePage::where(['status' => 1])->get()->append(['title', 'description']);

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'pages'      => $pages,
        ]);
    }

    /**
     * @param $slug
     */
    public function customPage($slug)
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 7])->first();
        $page       = CustomizeablePage::where(['slug' => $slug, 'status' => 1])->firstOr(
            function () {
                throw new HttpResponseException(response()->json(['status' => 0, 'message' => __('Page not found')], 404));
            }
        )->append(['title', 'description']);

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
        ]);
    }

    /**
     * @param Request $request
     */
    public function services(Request $request)
    {
        $seo_setting = SeoSetting::where('id', 5)->first();

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();

        $service_areas = City::orderBy('name', 'asc')->select('id', 'name', 'slug')->where('status', 1)->get();

        $categories = Category::orderBy('slug', 'asc')->where('status', 1)->get();

        $service_pagiante_qty = CustomPagination::whereId('2')->first()->qty;
        $services             = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'is_banned', 'status', 'approve_by_admin');

        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $services = $services->where('category_id', $category->id);
            }
        }

        if ($request->service_area) {
            $services = $services->whereHas('provider', function ($query) use ($request) {
                $service_area = City::where('slug', $request->service_area)->first();
                if ($service_area) {
                    $query->where('city_id', $service_area->id);
                }
            });
        }

        if ($request->price_range) {
            if ($request->price_range == 'low_price') {
                $services = $services->orderBy('price', 'asc');
            } elseif ($request->price_range == 'high_price') {
                $services = $services->orderBy('price', 'desc');
            } else {
                $services = $services->orderBy('id', 'desc');
            }
        }

        if ($request->rating) {
            $services->when($request->rating, function ($query) use ($request) {
                $query->wherehas('activeReviews', function ($query) use ($request) {
                    $query->selectRaw('activeReviews.*, avg(rating) as average_rating')
                        ->groupBy('id')
                        ->havingRaw('average_rating = ?', [$request->rating]);
                });
            });
        }

        if ($request->others) {
            if ($request->others == 'asc') {
                $services = $services->orderBy('name', 'asc');
            } elseif ($request->others == 'desc') {
                $services = $services->orderBy('name', 'desc');
            }
        } else {
            $services = $services->orderBy('id', 'desc');
        }

        if ($request->service_type) {
            if ($request->service_type == 'featured') {
                $services = $services->where('make_featured', 1);
            } elseif ($request->service_type == 'popular') {
                $services = $services->where('make_popular', 1);
            }
        }

        if ($request->search) {
            $services = $services->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('details', 'LIKE', '%' . $request->search . '%');
            });
        }

        $services = $services->get();

        $setting       = Setting::first();
        $currency_icon = (object) ['icon' => getApiCurrencyIcon()];

        // partner start

        $partner_visbility = false;
        $partner_control   = SectionControl::where('id', 41)->first();
        if ($partner_control->status == 1) {
            $partner_visbility = true;
        }
        $partners = Partner::where(['status' => 1])->get()->take($partner_control->qty);
        // end partner

        return response()->json([
            'seo_setting'       => $seo_setting,
            'breadcrumb'        => $breadcrumb,
            'service_areas'     => $service_areas,
            'categories'        => $categories,
            'services'          => $services,
            'currency_icon'     => $currency_icon,
            'partner_visbility' => $partner_visbility,
            'partners'          => $partners,
        ]);
    }

    /**
     * @param $slug
     */
    public function service($slug)
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider', 'activeReviews')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            return response()->json(['message' => __('user.Service Not Found')], 403);
        }

        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];

        $schedule_list = [];

        foreach ($days as $day_item) {
            $schedule_item = AppointmentSchedule::where('user_id', $service->provider_id)->where('day', $day_item)->orderBy('start_time', 'asc')->first();

            if ($schedule_item) {
                $start_time = strtoupper(date('h:i A', strtotime($schedule_item->start_time)));

                $schedule_item = AppointmentSchedule::where('user_id', $service->provider_id)->where('day', $day_item)->orderBy('end_time', 'desc')->first();
                $end_time      = strtoupper(date('h:i A', strtotime($schedule_item->end_time)));

                $schedule = [
                    'day'        => $day_item,
                    'start_time' => $start_time,
                    'end_time'   => $end_time,
                ];

                $schedule_list[] = $schedule;
            }
        }

        $what_you_will_get = [];
        if ($service->what_you_will_provide) {
            $provides = json_decode($service->what_you_will_provide);
            foreach ($provides as $provide) {
                $what_you_will_get[] = $provide;
            }
        }

        $benifits = [];
        if ($service->benifit) {
            $exist_benifits = json_decode($service->benifit);
            foreach ($exist_benifits as $exist_benifit) {
                $benifits[] = $exist_benifit;
            }
        }

        $review_pagiante_qty = CustomPagination::whereId('5')->first()->qty;

        $reviews = Review::with('user')->where(['provider_id' => $service->provider_id, 'status' => 1, 'service_id' => $service->id])->paginate($review_pagiante_qty);

        $setting        = Setting::first();
        $default_avatar = (object) ['image' => $setting->default_avatar];
        $currency_icon  = (object) ['icon' => getApiCurrencyIcon()];

        $package_features = [];
        if ($service->package_features) {
            $features = json_decode($service->package_features);
            foreach ($features as $feature) {
                $package_features[] = $feature;
            }
        }

        $provider = $service->provider;

        $complete_order = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count() ?? 0;

        $total_review   = Review::where(['provider_id' => $service->provider_id, 'status' => 1])->count();
        $average_rating = Review::where(['provider_id' => $service->provider_id, 'status' => 1])->avg('rating');

        $reviewQty   = $total_review;
        $reviewPoint = 0;
        $half_rating = false;
        if ($reviewQty > 0) {
            $average     = $average_rating;
            $intAverage  = intval($average);
            $nextValue   = $intAverage + 1;
            $reviewPoint = $intAverage;
            $half_rating = false;
            if ($intAverage < $average && $average < $nextValue) {
                $reviewPoint = $intAverage + 0.5;
                $half_rating = true;
            }
        }

        $recaptchaSetting = googleRecaptchaObject();

        $related_services = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'is_banned', 'status', 'approve_by_admin')->where('category_id', $service->category_id)->where('id', '!=', $service->id)->get();

        return response()->json([
            'breadcrumb'        => $breadcrumb,
            'service'           => $service,
            'what_you_will_get' => $what_you_will_get,
            'benifits'          => $benifits,
            'schedule_list'     => $schedule_list,
            'reviews'           => $reviews,
            'default_avatar'    => $default_avatar,
            'currency_icon'     => $currency_icon,
            'package_features'  => $package_features,
            'provider'          => $provider,
            'complete_order'    => $complete_order,
            'average_rating'    => $average_rating,
            'half_rating'       => $half_rating,
            'total_review'      => $total_review,
            'review_point'      => $reviewPoint,
            'recaptchaSetting'  => $recaptchaSetting,
            'related_services'  => $related_services,
        ]);
    }

    /**
     * @param Request $request
     */
    public function storeServiceReview(Request $request)
    {
        $rules = [
            'provider_id'          => 'required',
            'service_id'           => 'required',
            'rating'               => 'required',
            'comment'              => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];

        $customMessages = [
            'provider_id.required' => __('Provider is required'),
            'service_id.required'  => __('Service is required'),
            'rating.required'      => __('Rating is required'),
            'comment.required'     => __('Comment is required'),
            'g-recaptcha-response' => __('Recaptcha is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        // if(!Auth::check('web-api')){
        //     return response()->json(['message' => __('Please Login First')],401);
        // }
        $user = Auth::guard('api')->user();

        $exist_order = Order::where(['client_id' => $user->id, 'service_id' => $request->service_id, 'order_status' => 'complete'])->count();

        if ($exist_order == 0) {
            $notification = __('You can not make review before book any service');
            return response()->json(['status' => 0, 'message' => $notification], 403);
        }

        $exist_review = Review::where(['service_id' => $request->service_id, 'user_id' => $user->id])->count();

        if ($exist_review >= $exist_order) {
            $notification = __('Review already submited, you can not make multiple review on a single order');
            return response()->json(['status' => 0, 'message' => $notification], 403);
        }

        $review              = new Review();
        $review->user_id     = $user->id;
        $review->service_id  = $request->service_id;
        $review->provider_id = $request->provider_id;
        $review->review      = $request->comment;
        $review->rating      = $request->rating;
        $review->save();

        $notification = __('Review submitted successfully');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    /**
     * @param Request      $request
     * @param $user_name
     */
    public function provider(Request $request, $user_name)
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 9])->first();

        $provider = User::where(['user_name' => $user_name])->select('id', 'name', 'user_name', 'phone', 'email', 'image', 'created_at', 'designation', 'address')->firstOr(function () {
            throw new JsonException(__('user.Provider Not Found'), 404);
        });

        $setting        = Setting::first();
        $default_avatar = (object) ['image' => $setting->default_avatar];
        $currency_icon  = (object) ['icon' => getApiCurrencyIcon()];

        $complete_order = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count() ?? 0;

        $canceled_order = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        $total_review = Review::where(['provider_id' => $provider->id, 'status' => 1])->count();

        $service_pagiante_qty = CustomPagination::whereId('3')->first()->qty;
        $services             = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0, 'provider_id' => $provider->id])->orderBy('id', 'desc')->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'is_banned', 'status', 'approve_by_admin');

        if ($request->search) {
            $services = $services->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('details', 'LIKE', '%' . $request->search . '%');
        }

        $services = $services->paginate($service_pagiante_qty);

        $services = $services->appends($request->all());

        $partners = Partner::where(['status' => 1])->get();

        return response()->json([
            'breadcrumb'     => $breadcrumb,
            'provider'       => UserResource::make($provider),
            'default_avatar' => $default_avatar,
            'currency_icon'  => $currency_icon,
            'complete_order' => $complete_order,
            'canceled_order' => $canceled_order,
            'total_review'   => $total_review,
            'services'       => $services,
            'partners'       => $partners,
        ]);
    }

    /**
     * @param Request $request
     */
    public function subscribeRequest(Request $request)
    {
        if ($request->email != null) {
            $isExist = NewsLetter::where('email', $request->email)->count();
            if ($isExist == 0) {
                $subscriber               = new NewsLetter();
                $subscriber->email        = $request->email;
                $subscriber->verify_token = Str::random(25);
                $subscriber->save();

                MailHelper::setMailConfig();

                $template = EmailTemplate::where('id', 3)->first();
                $message  = $template->message;
                $subject  = $template->subject;

                MailSender::sendMail($subscriber->email, $subject, $message, [
                    __('Verify Your Email') => route('subscriber-verification', $subscriber->verify_token),
                ]);

                return response()->json(['status' => 1, 'message' => __('Subscription successfully, please verified your email')]);

            } else {
                return response()->json(['status' => 0, 'message' => __('Email already exist')], 403);
            }
        } else {
            return response()->json(['status' => 0, 'message' => __('Email Field is required')], 422);
        }
    }

    /**
     * @param $token
     */
    public function subscriberVerifcation($token)
    {
        $subscriber = NewsLetter::where('verify_token', $token)->first();
        if ($subscriber) {
            $subscriber->verify_token = null;
            $subscriber->is_verified  = 1;
            $subscriber->status       = 'verified';
            $subscriber->save();
            $notification = __('Email verification successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('home')->with($notification);
        } else {
            $notification = __('Invalid token');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('home')->with($notification);
        }

    }

    /**
     * @param $file
     */
    public function downloadListingFile($file)
    {
        $filepath = public_path() . "/uploads/custom-images/" . $file;
        return response()->download($filepath);
    }

    /**
     * @param $key
     */
    public function getLocalizationData($key = null)
    {
        $lang = getTranslationLangCode();

        $path = base_path('lang/' . $lang . '.json');

        if (!file_exists($path)) {
            return response()->json([]);
        }

        $data = json_decode(file_get_contents($path), true);

        if ($key) {
            return response()->json([
                $key => $data[$key],
            ]);
        } else {
            return response()->json($data);
        }
    }

}
