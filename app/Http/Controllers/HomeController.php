<?php

namespace App\Http\Controllers;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
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
use App\Models\Order;
use App\Models\Partner;
use App\Models\PopularPost;
use App\Models\Review;
use App\Models\SectionContent;
use App\Models\SectionControl;
use App\Models\SeoSetting;
use App\Models\ServiceLead;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TermsAndCondition;
use App\Models\Testimonial;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\NewsLetter\app\Models\NewsLetter;
use Modules\PageBuilder\app\Models\CustomizeablePage;

class HomeController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        setTheme();

        $contents    = SectionContent::all();
        $control     = SectionControl::get();
        $setting     = Setting::first();
        $seo_setting = SeoSetting::where('id', 1)->first();

        // intro section start

        $intro_visibility = false;
        $intro            = $control->where('id', 1)->first();
        if ($intro && $intro->status == 1) {
            $intro_visibility = true;
        }

        $intro_section = Slider::with('translation')->first();

        $service_areas = City::orderBy('name', 'asc')->select('id', 'name', 'slug')->where('status', 1)->get();
        $popular_tag   = $intro_section ? json_decode($intro_section->popular_tag) : null;

        // intro section end

        // category section start

        $category_control    = $control->where('id', 2)->first();
        $category_visibility = false;
        if ($category_control && $category_control->status == 1) {
            $category_visibility = true;
        }

        $category_content = $contents->where('id', 1)->first();
        $category_section = (object) [
            'visibility'  => $category_visibility,
            'title'       => $category_content ? $category_content->title : '',
            'description' => $category_content ? $category_content->description : '',
        ];

        $search_categories = Category::withCount(['service' => function ($query) {
            $query->where('status', 1)->where('approve_by_admin', 1);
        }])->orderBy('slug', 'asc')->where('status', 1)->get();
        // Show all active categories (remove limit)
        $categories = Category::withCount(['service' => function ($query) {
            $query->where('status', 1)->where('approve_by_admin', 1);
        }])->orderBy('slug', 'asc')->where('status', 1)->get();

        // category section end

        // featured section start

        $featured_control            = $control->where('id', 3)->first();
        $featured_section_visibility = false;
        if ($featured_control && $featured_control->status == 1) {
            $featured_section_visibility = true;
        }

        $featured_service_content = $contents->where('id', 2)->first();
        $featured_service_section = (object) [
            'visibility'  => $featured_section_visibility,
            'title'       => $featured_service_content ? $featured_service_content->title : '',
            'description' => $featured_service_content ? $featured_service_content->description : '',
        ];

        $featured_services = Service::with('category.translation', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->orderBy('id', 'desc')->get();

        // featured section end

        // coundown section start

        $coundown_visibility = false;
        $coundown_control    = $control->where('id', 4)->first();
        if ($coundown_control && $coundown_control->status == 1) {
            $coundown_visibility = true;
        }

        $coundown_qty = $coundown_control ? $coundown_control->qty : 4;
        $counters = Counter::with('translation')->where('status', 1)->get()->take($coundown_qty);

        $counter_bg_image = ['image' => $setting->counter_bg_image];
        $counter_bg_image = (object) $counter_bg_image;

        // coundown section end

        // popular section start

        $popular_control            = $control->where('id', 5)->first();
        $popular_section_visibility = false;
        if ($popular_control && $popular_control->status == 1) {
            $popular_section_visibility = true;
        }

        $popular_service_content = $contents->where('id', 3)->first();
        $popular_service_section = (object) [
            'visibility'  => $popular_section_visibility,
            'title'       => $popular_service_content ? $popular_service_content->title : '',
            'description' => $popular_service_content ? $popular_service_content->description : '',
        ];

        $popular_services = Service::with('category.translation', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->orderBy('id', 'desc')->get();

        // popular section end

        $currency_icon = ['icon' => $setting->currency_icon];
        $currency_icon = (object) $currency_icon;

        // join as provider section start

        $join_as_provider_visibility = false;
        $provider_control            = $control->where('id', 6)->first();
        if ($provider_control && $provider_control->status == 1) {
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
        if ($app_control && $app_control->status == 1) {
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
        if ($testimonial_control && $testimonial_control->status == 1) {
            $testimonial_visibility = true;
        }

        $testimonial_content = $contents->where('id', 4)->first();
        $testimonial_section = (object) [
            'visibility'  => $testimonial_visibility,
            'title'       => $testimonial_content ? $testimonial_content->title : '',
            'description' => $testimonial_content ? $testimonial_content->description : '',
        ];

        $testimonial_qty = $testimonial_control ? $testimonial_control->qty : 6;
        $testimonials = Testimonial::with('translation')->where('status', 1)->get()->take($testimonial_qty);

        // testimonial section end

        // blog section start

        $blog_control    = $control->where('id', 9)->first();
        $blog_visibility = false;
        if ($blog_control && $blog_control->status == 1) {
            $blog_visibility = true;
        }

        $blog_content = $contents->where('id', 5)->first();
        $blog_section = (object) [
            'visibility'  => $blog_visibility,
            'title'       => $blog_content ? $blog_content->title : '',
            'description' => $blog_content ? $blog_content->description : '',
        ];

        $blog_qty = $blog_control ? $blog_control->qty : 6;
        $blogs = Blog::select('id', 'title', 'image', 'slug', 'status', 'show_homepage')->where(['status' => 1, 'show_homepage' => 1])->orderBy('id', 'desc')->get()->take($blog_qty);

        // blog section end

        // home improvement section start
        $home_improvement_visibility = true; // Always visible for now, can be controlled via section_control later
        
        // Map home improvement categories to database category slugs
        // This mapping connects the home improvement section categories to actual categories in database
        $home_improvement_categories = [
            'Handymen' => 'handyman',
            'Electrical' => 'electrical',
            'HVAC' => 'ac-repair', // Assuming HVAC maps to AC repair
            'Plumbing' => 'plumbing',
            'Flooring' => 'flooring',
            'Lawn Care' => 'lawn-care',
            'Painting' => 'painting',
            'Windows' => 'windows',
            'Appliances' => 'appliances',
            'Remodeling' => 'remodeling',
            'Roofing' => 'roofing',
            'Doors' => 'doors',
        ];
        
        // Get all categories with service count and create a mapping for home improvement categories
        $all_categories = Category::withCount(['service' => function ($query) {
            $query->where('status', 1)->where('approve_by_admin', 1);
        }])->where('status', 1)->get()->keyBy('slug');
        
        $home_improvement_category_map = [];
        
        foreach ($home_improvement_categories as $display_name => $slug) {
            $category = $all_categories->get($slug);
            $hasServices = $category && $category->service_count > 0;
            
            $home_improvement_category_map[$display_name] = [
                'slug' => $slug,
                'exists' => $category ? true : false,
                'name' => $category ? $category->name : $display_name,
                'route' => $hasServices 
                    ? route('services', ['category' => $slug]) 
                    : url('ready-to-booking/custom-request') . '?query=' . urlencode($category ? $category->name : $display_name) . '&category=' . $slug
            ];
        }

        // home improvement section end

        // promotional section start
        $promotional_section_visibility = true; // Always visible for now, can be controlled via section_control later
        // promotional section end

        // services overview section start
        $services_overview_visibility = true; // Always visible for now, can be controlled via section_control later
        // services overview section end

        // benefits section start
        $benefits_section_visibility = true; // Always visible for now, can be controlled via section_control later
        // benefits section end

        // why customers love section start
        $why_customers_love_visibility = true; // Always visible for now, can be controlled via section_control later
        // why customers love section end

        // powering home project section start
        $powering_home_visibility = true; // Always visible for now, can be controlled via section_control later
        // powering home project section end

        // subscribe section start

        $subscription_visbility = false;
        $subscription_control   = $control->where('id', 10)->first();
        if ($subscription_control && $subscription_control->status == 1) {
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
        if ($partner_control && $partner_control->status == 1) {
            $partner_visbility = true;
        }

        $partner_qty = $partner_control ? $partner_control->qty : 6;
        $partners = Partner::where(['status' => 1])->get()->take($partner_qty);

        // parnter end

        // contact start

        $contact_visbility = false;
        $contact_control   = $control->where('id', 21)->first();
        if ($contact_control && $contact_control->status == 1) {
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
        if ($work_control && $work_control->status == 1) {
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

        $selected_theme = Session::get('selected_theme');
        if ($selected_theme == 'theme_one') {
            return view('website.index')->with([
                'seo_setting'                  => $seo_setting,
                'intro_visibility'             => $intro_visibility,
                'intro_section'                => $intro_section,
                'popular_tag'                  => $popular_tag,
                'search_categories'            => $search_categories,
                'service_areas'                => $service_areas,
                'category_section'             => $category_section,
                'categories'                   => $categories,
                'featured_service_section'     => $featured_service_section,
                'featured_services'            => $featured_services,
                'currency_icon'                => $currency_icon,
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
                'home_improvement_visibility'  => $home_improvement_visibility,
                'home_improvement_category_map' => $home_improvement_category_map,
                'promotional_section_visibility' => $promotional_section_visibility,
                'services_overview_visibility' => $services_overview_visibility,
                'benefits_section_visibility' => $benefits_section_visibility,
                'why_customers_love_visibility' => $why_customers_love_visibility,
                'powering_home_visibility' => $powering_home_visibility,
                'subscription_visbility'       => $subscription_visbility,
                'subscriber'                   => $subscriber,
            ]);
        } elseif ($selected_theme == 'theme_two') {
            return view('website.index2')->with([
                'seo_setting'                  => $seo_setting,
                'intro_visibility'             => $intro_visibility,
                'intro_section'                => $intro_section,
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
                'home_improvement_visibility'  => $home_improvement_visibility,
                'promotional_section_visibility' => $promotional_section_visibility,
                'services_overview_visibility' => $services_overview_visibility,
                'benefits_section_visibility' => $benefits_section_visibility,
                'why_customers_love_visibility' => $why_customers_love_visibility,
                'powering_home_visibility' => $powering_home_visibility,
                'subscription_visbility'       => $subscription_visbility,
                'subscriber'                   => $subscriber,
                'partner_visbility'            => $partner_visbility,
                'partners'                     => $partners,
            ]);
        } elseif ($selected_theme == 'theme_three') {
            return view('website.index3')->with([
                'seo_setting'                  => $seo_setting,
                'intro_visibility'             => $intro_visibility,
                'intro_section'                => $intro_section,
                'popular_tag'                  => $popular_tag,
                'partner_visbility'            => $partner_visbility,
                'partners'                     => $partners,
                'search_categories'            => $search_categories,
                'service_areas'                => $service_areas,
                'category_section'             => $category_section,
                'categories'                   => $categories,
                'featured_service_section'     => $featured_service_section,
                'featured_services'            => $featured_services,
                'currency_icon'                => $currency_icon,
                'coundown_visibility'          => $coundown_visibility,
                'counter_bg_image'             => $counter_bg_image,
                'counters'                     => $counters,
                'popular_service_section'      => $popular_service_section,
                'popular_services'             => $popular_services,
                'work_visbility'               => $work_visbility,
                'how_it_work'                  => $how_it_work,
                'join_as_provider_visibility'  => $join_as_provider_visibility,
                'join_as_a_provider'           => $join_as_a_provider,
                'mobile_app_section_visbility' => $mobile_app_section_visbility,
                'mobile_app'                   => $mobile_app,
                'testimonial_section'          => $testimonial_section,
                'testimonials'                 => $testimonials,
                'blog_section'                 => $blog_section,
                'blogs'                        => $blogs,
                'home_improvement_visibility'  => $home_improvement_visibility,
                'home_improvement_category_map' => $home_improvement_category_map,
                'promotional_section_visibility' => $promotional_section_visibility,
                'services_overview_visibility' => $services_overview_visibility,
                'benefits_section_visibility' => $benefits_section_visibility,
                'why_customers_love_visibility' => $why_customers_love_visibility,
                'powering_home_visibility' => $powering_home_visibility,
                'subscription_visbility'       => $subscription_visbility,
                'subscriber'                   => $subscriber,
            ]);
        } else {
            return view('website.index')->with([
                'seo_setting'                  => $seo_setting,
                'intro_visibility'             => $intro_visibility,
                'intro_section'                => $intro_section,
                'popular_tag'                  => $popular_tag,
                'search_categories'            => $search_categories,
                'service_areas'                => $service_areas,
                'category_section'             => $category_section,
                'categories'                   => $categories,
                'featured_service_section'     => $featured_service_section,
                'featured_services'            => $featured_services,
                'currency_icon'                => $currency_icon,
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
                'home_improvement_visibility'  => $home_improvement_visibility,
                'home_improvement_category_map' => $home_improvement_category_map,
                'promotional_section_visibility' => $promotional_section_visibility,
                'services_overview_visibility' => $services_overview_visibility,
                'benefits_section_visibility' => $benefits_section_visibility,
                'why_customers_love_visibility' => $why_customers_love_visibility,
                'powering_home_visibility' => $powering_home_visibility,
                'subscription_visbility'       => $subscription_visbility,
                'subscriber'                   => $subscriber,
            ]);
        }
    }

    public function join_as_a_provider()
    {
        $breadcrumb       = BreadcrumbImage::where(['id' => 12])->first();
        
        // Filter countries to only show: United States, United Kingdom, Canada, Australia, New Zealand, UAE
        $allowedCountries = ['United States', 'United Kingdom', 'Canada', 'Australia', 'New Zealand', 'UAE', 'United Arab Emirates'];
        $countries        = Country::where('status', 1)
            ->whereIn('name', $allowedCountries)
            ->orderBy('name', 'asc')
            ->get();
        
        $recaptchaSetting = googleRecaptchaObject();
        
        // Get subscription plans for payment step
        $subscriptionPlans = \Modules\Subscription\Entities\SubscriptionPlan::where('status', 1)->orderBy('serial', 'asc')->get();
        
        // Get categories for services selection
        $categories = Category::where('status', 1)->with('translation')->get();
        
        // Get available job posts/projects for feed (approved and enabled only)
        $availableJobs = \Modules\JobPost\Entities\JobPost::where([
            'status'            => 'enable',
            'approved_by_admin' => 'approved',
        ])->with('category', 'city')->latest()->limit(20)->get();
        
        // Get setting for currency icon
        $setting = Setting::first();
        getSessionCurrency(); // Ensure currency session is set
        
        // Check if returning from payment success
        $paymentSuccess = request()->get('payment_success');
        $currentStep = request()->get('step', 1);
        $paymentCompleted = false;
        
        if ($paymentSuccess && Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            // Check if user has active subscription
            $activeSubscription = \Modules\Subscription\Entities\PurchaseHistory::where('provider_id', $user->id)
                ->where('payment_status', 'success')
                ->where('status', 'active')
                ->latest()
                ->first();
            
            if ($activeSubscription) {
                $paymentCompleted = true;
                session(['provider_registration_plan_id' => $activeSubscription->plan_id]);
            }
        }

        return view('website.join_as_a_provider')->with([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'countries'        => $countries,
            'recaptchaSetting' => $recaptchaSetting,
            'subscriptionPlans' => $subscriptionPlans,
            'categories'       => $categories,
            'setting'          => $setting,
            'availableJobs'    => $availableJobs,
            'paymentCompleted' => $paymentCompleted,
            'currentStep'      => $currentStep,
        ]);
    }
    
    
    public function submitServiceLead(Request $request)
{
    $rules = [
        'category_id' => 'required|exists:categories,id',
        'service_type' => 'required|string',
        'zip_code' => 'required|string|max:20',
        'location_city' => 'nullable|string',
        'location_state' => 'nullable|string',
        'location_country' => 'nullable|string',
        'additional_details' => 'nullable|string|max:1000',
    ];

    $customMessages = [
        'category_id.required' => __('Service category is required'),
        'service_type.required' => __('Service type is required'),
        'zip_code.required' => __('ZIP code is required'),
    ];

    $this->validate($request, $rules, $customMessages);

    try {
        // Create the lead
        $lead = ServiceLead::create([
            'category_id' => $request->category_id,
            'service_type' => $request->service_type,
            'zip_code' => $request->zip_code,
            'location_city' => $request->location_city,
            'location_state' => $request->location_state,
            'location_country' => $request->location_country,
            'additional_details' => $request->additional_details,
            'status' => 'new',
        ]);

        // Find matching providers based on category and location
        $matchedProviders = $this->findMatchingProvidersForLead($lead);
        
        // Store matched provider IDs in the lead
        $lead->update([
            'matched_provider_ids' => $matchedProviders
        ]);

        // TODO: Optionally send email/SMS notifications to matched providers
        // $this->notifyMatchedProviders($matchedProviders, $lead);

        return response()->json([
            'status' => 'success',
            'message' => __('Your service request has been submitted! We\'ll connect you with top providers.'),
            'lead_id' => $lead->lead_id,
            'matched_providers_count' => count($matchedProviders)
        ]);

    } catch (\Exception $e) {
        \Log::error('Lead submission error: ' . $e->getMessage());
        
        return response()->json([
            'status' => 'error',
            'message' => __('Something went wrong. Please try again.')
        ], 500);
    }
}

/**
 * Find providers that match the lead criteria
 * Matches based on: 1) Service category 2) ZIP code/service area 3) Active/paid status
 * 
 * @param ServiceLead $lead
 * @return array Array of provider IDs
 */
private function findMatchingProvidersForLead($lead)
{
    // Step 1: Find active, paid providers with services in the same category
    $providers = User::where('is_provider', 1)
        ->where('status', 1)
        ->where('payment_status', 'paid')
        ->where('account_status', 'active')
        ->whereHas('services', function($query) use ($lead) {
            $query->where('category_id', $lead->category_id)
                  ->where('status', 1)
                  ->where('approve_by_admin', 1);
        })
        ->get();

    $matchedProviderIds = [];

    // Step 2: Filter by ZIP code matching
    foreach ($providers as $provider) {
        if ($this->zipCodesMatchForLead($provider->service_area, $lead->zip_code)) {
            $matchedProviderIds[] = $provider->id;
        }
    }

    // Step 3: If no exact ZIP matches, expand search to providers in same category
    // (you can make this more sophisticated later based on your needs)
    if (empty($matchedProviderIds)) {
        $providers = User::where('is_provider', 1)
            ->where('status', 1)
            ->where('payment_status', 'paid')
            ->where('account_status', 'active')
            ->whereHas('services', function($query) use ($lead) {
                $query->where('category_id', $lead->category_id)
                      ->where('status', 1)
                      ->where('approve_by_admin', 1);
            })
            ->limit(10) // Limit to top 10 providers in category
            ->get();

        foreach ($providers as $provider) {
            $matchedProviderIds[] = $provider->id;
        }
    }

    return $matchedProviderIds;
}

/**
 * Check if provider's ZIP code matches lead's ZIP code
 * Uses flexible matching: exact match OR same region (first 3 digits for US ZIP codes)
 * 
 * @param string $providerZip
 * @param string $leadZip
 * @return bool
 */
private function zipCodesMatchForLead($providerZip, $leadZip)
{
    if (empty($providerZip) || empty($leadZip)) {
        return false;
    }

    // Clean up ZIP codes (remove spaces and make uppercase)
    $providerZip = strtoupper(trim($providerZip));
    $leadZip = strtoupper(trim($leadZip));

    // Exact match
    if ($providerZip === $leadZip) {
        return true;
    }

    // For US ZIP codes, check if first 3 digits match (same region)
    // Example: 10001 and 10002 would match (both in NYC area)
    if (strlen($providerZip) >= 3 && strlen($leadZip) >= 3) {
        if (is_numeric(substr($providerZip, 0, 3)) && is_numeric(substr($leadZip, 0, 3))) {
            return substr($providerZip, 0, 3) === substr($leadZip, 0, 3);
        }
    }

    return false;
}

/**
 * Get service type options for a specific category (AJAX endpoint)
 * This is called when the lead form needs service type options
 * 
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 */
public function getServiceTypeOptions(Request $request)
{
    $categorySlug = $request->get('category');
    
    // Try to fetch real services from the database first
    $types = Service::whereHas('category', function($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })
        ->where('status', 1)
        ->where('approve_by_admin', 1)
        ->where('is_banned', 0)
        ->pluck('name')
        ->toArray();

    if (empty($types)) {
        // Map each category slug to its service type options (Fallback)
        $serviceTypesByCategory = [
            'plumbing' => ['Installation', 'Repair', 'Maintenance', 'Emergency', 'Other'],
            'electric-repair' => ['Outlet/switch installation', 'Light fixture installation', 'Electrical panel work', 'Wiring repair', 'Other'],
            'hvac' => ['AC repair', 'Heating repair', 'Installation', 'Maintenance', 'Other'],
            'moving' => ['Local move', 'Long distance', 'Packing services', 'Storage', 'Other'],
            'gutter-cleaning' => ['Cleaning', 'Repair', 'Installation', 'Inspection', 'Other'],
            'drywall-installation' => ['Installation', 'Repair', 'Texturing', 'Painting prep', 'Other'],
            'metal-roofing' => ['Installation', 'Repair', 'Inspection', 'Replacement', 'Other'],
            'carpet-cleaning' => ['Deep cleaning', 'Stain removal', 'Pet odor removal', 'Steam cleaning', 'Other'],
            'flooring-installation' => ['Hardwood', 'Tile', 'Carpet', 'Vinyl', 'Laminate', 'Other'],
            'flooring' => ['Installation', 'Repair', 'Refinishing', 'Sanding', 'Other'],
            'interior-designer' => ['Consultation', 'Full design', 'Room makeover', 'Color consultation', 'Other'],
            'architect' => ['New construction', 'Renovation', 'Addition', 'Plans', 'Other'],
            'kitchen-remodeling' => ['Full remodel', 'Cabinet installation', 'Countertops', 'Flooring', 'Other'],
            'general-contractor' => ['New construction', 'Renovation', 'Addition', 'Repair', 'Other'],
            'painting' => ['Interior', 'Exterior', 'Cabinet painting', 'Deck staining', 'Other'],
            'appliances-installation' => ['Refrigerator', 'Washer/dryer', 'Dishwasher', 'Oven', 'Other'],
            'landscaping' => ['Design', 'Installation', 'Maintenance', 'Hardscaping', 'Other'],
            'handyman' => ['General repairs', 'Furniture assembly', 'TV mounting', 'Picture hanging', 'Other'],
            'duct-cleaning' => ['Air duct cleaning', 'Dryer vent cleaning', 'Inspection', 'Repair', 'Other'],
            'home-remodeling' => ['Full remodel', 'Kitchen', 'Bathroom', 'Basement', 'Other'],
            'window-installation' => ['Installation', 'Replacement', 'Repair', 'Screen repair', 'Other'],
            'concrete' => ['Driveway', 'Patio', 'Foundation', 'Repair', 'Other'],
            'bathroom-remodeling' => ['Full remodel', 'Shower/tub', 'Vanity', 'Flooring', 'Other'],
            'cleaning' => ['House cleaning', 'Deep cleaning', 'Move-out cleaning', 'Commercial', 'Other'],
            'wood' => ['Deck building', 'Fence installation', 'Carpentry', 'Repair', 'Other'],
            'tree' => ['Trimming', 'Removal', 'Stump grinding', 'Planting', 'Other'],
            'engineering' => ['Structural', 'Electrical', 'Mechanical', 'Civil', 'Other'],
        ];

        // Return category-specific types or default types if category not found
        $types = $serviceTypesByCategory[$categorySlug] ?? ['General service', 'Repair', 'Installation', 'Maintenance', 'Emergency', 'Other'];
    }

    return response()->json([
        'status' => 'success',
        'service_types' => $types
    ]);
}

/**
 * Get all active service categories (AJAX endpoint)
 * Used to populate category dropdowns in the lead form
 * 
 * @return \Illuminate\Http\JsonResponse
 */
public function getServiceCategories()
{
    $categories = Category::where('status', 1)
        ->select('id', 'slug', 'icon')
        ->orderBy('slug', 'asc')
        ->get();

    return response()->json([
        'status' => 'success',
        'categories' => $categories
    ]);
}

    /**
     * @param Request $request
     */
    public function checkUserName(Request $request)
    {
        $user = User::where('user_name', $request->username)->count();
        if ($user == 0) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0, 'message' => __('User name already exist')]);
        }
    }

    /**
     * @param $id
     */
    public function stateByCountry($id)
    {
        $states   = CountryState::where(['status' => 1, 'country_id' => $id])->orderBy('name', 'asc')->get();
        $response = '<option value="">' . __('Select') . '</option>';
        if ($states->count() > 0) {
            foreach ($states as $state) {
                $response .= "<option value=" . $state->id . ">" . $state->name . "</option>";
            }
        }

        return response()->json(['states' => $response]);
    }

    /**
     * @param $id
     */
    public function cityByState($id)
    {
        $cities   = City::where(['status' => 1, 'country_state_id' => $id])->orderBy('name', 'asc')->get();
        $response = '<option value="">' . __('Select') . '</option>';
        if ($cities->count() > 0) {
            foreach ($cities as $city) {
                $response .= "<option value=" . $city->id . ">" . $city->name . "</option>";
            }
        }

        return response()->json(['cities' => $response]);
    }

    /**
     * @param Request $request
     */
    public function request_provider(Request $request)
    {
        try {
            // Check if user is logged in (from Step 1)
            if (!Auth::guard('web')->check()) {
                return response()->json([
                    'status' => 0,
                    'message' => __('Please complete Step 1 first to create your account')
                ], 401);
            }

            $user = Auth::guard('web')->user();
            
            // Validation rules - email should be unique except for current user
            $rules = [
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'services'              => 'required|array|min:1',
            'services.*'           => 'exists:categories,id',
            'profile_address'      => 'required',
            'state'                => 'required',
            'city'                 => 'required',
            'zip_code'             => 'required',
            'country'              => 'required|exists:countries,id',
            'profile_phone'        => 'required',
            'profile_email'        => 'required|email',
            'coverage_radius'      => 'required|in:30,50,100,200',
            'licensed'             => 'nullable|in:yes,no',
            'insured'              => 'nullable|in:yes,no',
            'agree'                => 'required',
            'g-recaptcha-response' => googleRecaptchaObject()->status !== 'inactive' ? new Captcha() : 'nullable',
        ];
        $customMessages = [
            'subscription_plan_id.required' => __('Please select a subscription plan'),
            'subscription_plan_id.exists'   => __('Selected plan is invalid'),
            'services.required'          => __('Please select at least one service'),
            'profile_address.required'   => __('Profile address is required'),
            'city.required'             => __('City is required'),
            'zip_code.required'         => __('Zip code is required'),
            'country.required'          => __('Country is required'),
            'profile_phone.required'    => __('Profile phone is required'),
            'profile_email.required'    => __('Profile email is required'),
            'profile_email.email'       => __('Please enter a valid email address'),
            'state.required'            => __('State is required'),
            'coverage_radius.required'  => __('Please select coverage radius'),
            'agree.required'           => __('You must agree to the Terms and Conditions'),
        ];
        $this->validate($request, $rules, $customMessages);

        // Update existing user account with profile details
        $user->company_name          = $request->company_name ?? null;
        $user->country_id            = $request->country;
        $user->state_id              = $request->state;
        $user->city_id               = $request->city;
        $user->zip_code              = $request->zip_code;
        
        // Store licensed, insured, coverage_radius, and show_services_without_details in separate columns
        // Check if columns exist before assigning to avoid database errors
        if (Schema::hasColumn('users', 'licensed')) {
            $user->licensed = $request->licensed ?? 'no';
        }
        
        if (Schema::hasColumn('users', 'insured')) {
            $user->insured = $request->insured ?? 'no';
        }
        
        if (Schema::hasColumn('users', 'coverage_radius')) {
            $user->coverage_radius = $request->coverage_radius;
        }
        
        // Set default value for show_services_without_details (providers can change this later)
        if (Schema::hasColumn('users', 'show_services_without_details')) {
            $user->show_services_without_details = 1; // Default to showing services without customer details
        }
        
        // If columns don't exist, store in designation as JSON (fallback)
        if (!Schema::hasColumn('users', 'licensed') || !Schema::hasColumn('users', 'insured') || 
            !Schema::hasColumn('users', 'coverage_radius') || !Schema::hasColumn('users', 'show_services_without_details')) {
            $providerInfo = [
                'licensed' => $request->licensed ?? 'no',
                'insured' => $request->insured ?? 'no',
                'coverage_radius' => $request->coverage_radius,
                'show_services_without_details' => 1 // Default enabled
            ];
            $user->designation = json_encode($providerInfo);
        }
        
        $user->save();

        // Store subscription plan selection in session for payment processing
        session(['provider_registration_plan_id' => $request->subscription_plan_id]);

        // Store selected services/categories (you may want to create a provider_services table)
        // For now, we'll store this information for later use when creating services

        // User is already logged in from Step 1, no need to login again
        
        $notification = __('Profile completed successfully!');
        return response()->json([
            'status' => 1,
            'message' => $notification
        ]);
        } catch (\Exception $e) {
            \Log::error('Provider Registration Error: ' . $e->getMessage());
            \Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 0,
                'message' => __('Registration failed. Please try again. Error: ') . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create provider account after Step 1
     */
    public function createProviderAccount(Request $request)
    {
        try {
            $rules = [
                'name'    => 'required',
                'email'   => 'required|email|unique:users',
                'phone'   => 'required',
                'address' => 'required',
            ];
            
            $customMessages = [
                'name.required'    => __('Name is required'),
                'email.required'   => __('Email is required'),
                'email.email'      => __('Please enter a valid email address'),
                'email.unique'     => __('Email already exists'),
                'phone.required'   => __('Phone is required'),
                'address.required' => __('Address is required'),
            ];
            
            $this->validate($request, $rules, $customMessages);

            // Generate username from name
            $username = \Illuminate\Support\Str::slug($request->name);
            $originalUsername = $username;
            $counter = 1;
            while (User::where('user_name', $username)->exists()) {
                $username = $originalUsername . '_' . $counter;
                $counter++;
            }

            // Generate a random password
            $password = Str::random(12);

            // Create user account (basic info only, profile will be completed in Step 4)
            $user                        = new User();
            $user->name                  = $request->name;
            $user->email                 = $request->email;
            $user->user_name             = $username;
            $user->phone                 = $request->phone;
            $user->address               = $request->address;
            $user->is_provider           = 1;
            $user->password              = Hash::make($password);
            $user->otp_mail_verify_token = Str::random(100);
            $user->status                = 1;
            $user->email_verified        = 1;
            $user->save();

            // Auto-login the user
            Auth::guard('web')->login($user);

            // Store user ID in session for later profile completion
            session(['provider_registration_user_id' => $user->id]);

            // Send welcome email
            MailSender::afterRegistrationMail($user, $user->name);

            return response()->json([
                'status' => 1,
                'message' => __('Account created successfully')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 0,
                'message' => __('Validation failed'),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Create Provider Account Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 0,
                'message' => __('Failed to create account. Please try again.')
            ], 500);
        }
    }

    /**
     * Store free plan for provider during registration
     */
    public function storeProviderPlan(Request $request)
    {
        try {
            if (!Auth::guard('web')->check()) {
                return response()->json([
                    'status' => 0,
                    'message' => __('You must be logged in to continue')
                ], 401);
            }

            $user = Auth::guard('web')->user();
            
            if ($user->is_provider !== 1) {
                return response()->json([
                    'status' => 0,
                    'message' => __('You are not a provider')
                ], 403);
            }

            $planId = $request->subscription_plan_id;
            $plan = \Modules\Subscription\Entities\SubscriptionPlan::where('status', 1)->find($planId);

            if (!$plan) {
                return response()->json([
                    'status' => 0,
                    'message' => __('Invalid plan selected')
                ], 404);
            }

            // Check if it's a free plan
            if ($plan->plan_price != 0) {
                return response()->json([
                    'status' => 0,
                    'message' => __('This method is only for free plans')
                ], 400);
            }

            // Use the existing free_enroll logic from PurchaseController
            $purchaseController = new \Modules\Subscription\Http\Controllers\Provider\PurchaseController();
            
            // Check if free plan already exists
            $free_exist = \Modules\Subscription\Entities\PurchaseHistory::where('provider_id', $user->id)
                ->where(['payment_method' => 'Free'])
                ->count();

            if ($free_exist == 0) {
                // Store subscription using reflection to call protected method
                $purchaseController->store_subscription($user, $plan, 'Free', 'free_enroll', 'success');
                
                // Store plan in session
                session(['provider_registration_plan_id' => $planId]);
                
                return response()->json([
                    'status' => 1,
                    'message' => __('Free plan enrolled successfully')
                ]);
            } else {
                // Already enrolled, just store in session
                session(['provider_registration_plan_id' => $planId]);
                
                return response()->json([
                    'status' => 1,
                    'message' => __('Plan already enrolled')
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Store Provider Plan Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 0,
                'message' => __('Failed to enroll plan. Please try again.')
            ], 500);
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

        $about                   = AboutUs::with('translation')->first();
        $how_it_works            = HowItWork::with('translation')->get();
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

        return view('website.about_us')->with([
            'active_theme'                => getActiveThemeLayout(),
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

        return view('website.contact_us')->with([
            'active_theme'     => getActiveThemeLayout(),
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
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
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

        return view('website.blog')->with([
            'active_theme'  => getActiveThemeLayout(),
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

        $popular_arr = [];
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

        return view('website.show_blog')->with([
            'active_theme'     => getActiveThemeLayout(),
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
        $faqs       = Faq::orderBy('id', 'desc')->where('status', 1)->get();

        $recaptchaSetting = googleRecaptchaObject();

        return view('website.faq')->with([
            'active_theme'     => getActiveThemeLayout(),
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

        return view('website.terms_and_conditions')->with([
            'active_theme'     => getActiveThemeLayout(),
            'breadcrumb'       => $breadcrumb,
            'terms_conditions' => $terms_conditions,
        ]);
    }

    public function privacyPolicy()
    {
        $breadcrumb    = BreadcrumbImage::where(['id' => 6])->first();
        $privacyPolicy = TermsAndCondition::first();
        $privacyPolicy = $privacyPolicy->privacy_policy;

        return view('website.privacy_policy')->with([
            'active_theme'  => getActiveThemeLayout(),
            'breadcrumb'    => $breadcrumb,
            'privacyPolicy' => $privacyPolicy,
        ]);
    }

    /**
     * @param $slug
     */
    public function customPage($slug)
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 7])->first();
        $page       = CustomizeablePage::where(['slug' => $slug, 'status' => 1])->firstOrFail();

        return view('website.custom_page')->with([
            'active_theme' => getActiveThemeLayout(),
            'breadcrumb'   => $breadcrumb,
            'page'         => $page,
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
        $services             = Service::with('category', 'provider', 'serviceAreas')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'is_banned', 'status', 'approve_by_admin');

        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $services = $services->where('category_id', $category->id);
            }
        }

        if ($request->service_area && $request->service_area != 'worldwide') {
            $services = $services->whereHas('serviceAreas', function ($query) use ($request) {
                $service_area = City::where('slug', $request->service_area)->first();
                if ($service_area) {
                    $query->where('city_id', $service_area->id);
                }
            });
        }

        // if($request->service_area){
        //     $services = $services->whereHas('provider', function($query) use ($request){
        //         $service_area = City::where('slug', $request->service_area)->first();
        //         if($service_area){
        //             $query->where('city_id', $service_area->id);
        //         }
        //     });
        // }

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

        if ($request->search) {
            $services = $services->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('details', 'LIKE', '%' . $request->search . '%');
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

        $services = $services->get();

        $setting       = Setting::first();
        $currency_icon = (object) ['icon' => $setting->currency_icon];

        // partner start

        $partner_visbility = false;
        $partner_control   = SectionControl::where('id', 41)->first();
        if ($partner_control->status == 1) {
            $partner_visbility = true;
        }
        $partners = Partner::where(['status' => 1])->get()->take($partner_control->qty);
        // end partner

        return view('website.service')->with([
            'active_theme'      => getActiveThemeLayout(),
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
            abort(404);
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

        $setting                    = Setting::first();
        $default_avatar             = (object) ['image' => $setting->default_avatar];
        $currency_icon              = (object) ['icon' => $setting->currency_icon];
        $show_provider_contact_info = (object) ['status' => $setting->show_provider_contact_info];

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

        return view('website.show_service')->with([
            'active_theme'               => getActiveThemeLayout(),
            'breadcrumb'                 => $breadcrumb,
            'service'                    => $service,
            'what_you_will_get'          => $what_you_will_get,
            'benifits'                   => $benifits,
            'schedule_list'              => $schedule_list,
            'reviews'                    => $reviews,
            'default_avatar'             => $default_avatar,
            'currency_icon'              => $currency_icon,
            'package_features'           => $package_features,
            'provider'                   => $provider,
            'complete_order'             => $complete_order,
            'average_rating'             => $average_rating,
            'half_rating'                => $half_rating,
            'total_review'               => $total_review,
            'review_point'               => $reviewPoint,
            'recaptchaSetting'           => $recaptchaSetting,
            'related_services'           => $related_services,
            'show_provider_contact_info' => $show_provider_contact_info,
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

        $user = Auth::guard('web')->user();

        $exist_order = Order::where(['client_id' => $user->id, 'service_id' => $request->service_id, 'order_status' => 'complete'])->count();

        if ($exist_order == 0) {
            $notification = __('You can not make review before book any service');
            return response()->json(['status' => 0, 'message' => $notification]);
        }

        $exist_review = Review::where(['service_id' => $request->service_id, 'user_id' => $user->id])->count();

        if ($exist_review >= $exist_order) {
            $notification = __('Review already submited, you can not make multiple review on a single order');
            return response()->json(['status' => 0, 'message' => $notification]);
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

        $provider = User::where(['user_name' => $user_name])->select('id', 'name', 'user_name', 'phone', 'email', 'image', 'created_at', 'designation', 'address')->firstOrFail();

        $setting                    = Setting::first();
        $default_avatar             = (object) ['image' => $setting->default_avatar];
        $currency_icon              = (object) ['icon' => $setting->currency_icon];
        $show_provider_contact_info = (object) ['status' => $setting->show_provider_contact_info];

        $complete_order = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count() ?? 0;

        $canceled_order = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        $total_review = Review::where(['provider_id' => $provider->id, 'status' => 1])->count();

        $service_pagiante_qty = CustomPagination::whereId('3')->first()->qty;
        $services             = Service::with('category', 'provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0, 'provider_id' => $provider->id])->orderBy('id', 'desc')->select('id', 'name', 'slug', 'image', 'price', 'category_id', 'provider_id', 'is_banned', 'status', 'approve_by_admin');

        if ($request->search) {
            $services = $services->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('details', 'LIKE', '%' . $request->search . '%');
        }

        $services = $services->get();

        $partners = Partner::where(['status' => 1])->get();

        return view('website.show_provider')->with([
            'active_theme'               => getActiveThemeLayout(),
            'breadcrumb'                 => $breadcrumb,
            'provider'                   => $provider,
            'default_avatar'             => $default_avatar,
            'currency_icon'              => $currency_icon,
            'complete_order'             => $complete_order,
            'canceled_order'             => $canceled_order,
            'total_review'               => $total_review,
            'services'                   => $services,
            'partners'                   => $partners,
            'show_provider_contact_info' => $show_provider_contact_info,
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
                return response()->json(['status' => 0, 'message' => __('Email already exist')]);
            }
        } else {
            return response()->json(['status' => 0, 'message' => __('Email Field is required')]);
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
}
