<?php

namespace Modules\GlobalSetting\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\City;
use App\Models\CompleteRequest;
use App\Models\ContactMessage;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\FacebookComment;
use App\Models\Faq;
use App\Models\FaqTranslation;
use App\Models\Message;
use App\Models\MessageDocument;
use App\Models\Order;
use App\Models\Partner;
use App\Models\PopularPost;
use App\Models\ProviderClientReport;
use App\Models\ProviderPaymentGateway;
use App\Models\ProviderWithdraw;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\SocialLoginInformation;
use App\Models\Testimonial;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Modules\GlobalSetting\app\Enums\WebsiteSettingEnum;
use Modules\GlobalSetting\app\Models\CustomCode;
use Modules\GlobalSetting\app\Models\CustomPagination;
use Modules\GlobalSetting\app\Models\SeoSetting;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobPostTranslation;
use Modules\JobPost\Entities\JobRequest;
use Modules\Kyc\Entities\KycInformation;
use Modules\NewsLetter\app\Models\NewsLetter;
use Modules\PageBuilder\app\Models\CustomizablePageTranslation;
use Modules\PageBuilder\app\Models\CustomizeablePage;
use Modules\Subscription\Entities\PurchaseHistory;
use Modules\Subscription\Entities\SubscriptionPlan;
use ZipArchive;

class GlobalSettingController extends Controller
{
    /**
     * @var mixed
     */
    protected $cachedSetting;

    public function __construct()
    {
        $this->cachedSetting = Cache::get('setting');
    }

    public function general_setting()
    {
        checkAdminHasPermissionAndThrowException('setting.view');

        $custom_paginations = CustomPagination::all();
        $all_timezones      = WebsiteSettingEnum::allTimeZones();
        $all_time_format    = WebsiteSettingEnum::allTimeFormat();
        $all_date_format    = WebsiteSettingEnum::allDateFormat();

        $setting_info = Setting::all();
        $setting      = [];
        foreach ($setting_info as $setting_item) {
            $setting[$setting_item->key] = $setting_item->value;
        }

        $settingData = (object) $setting;

        return view('globalsetting::settings.index', compact('custom_paginations', 'all_timezones', 'all_time_format', 'all_date_format', 'settingData'));
    }

    /**
     * @param Request $request
     */
    public function update_general_setting(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        $request->validate([
            'app_name'                      => 'sometimes',
            'timezone'                      => 'sometimes',
            'contact_message_receiver_mail' => 'sometimes|email',
            'is_queable'                    => 'sometimes|in:active,inactive',
            'comments_auto_approved'        => 'sometimes|in:active,inactive',
            'search_engine_indexing'        => 'sometimes|in:active,inactive',
            'sidebar_lg_header'             => 'sometimes',
            'sidebar_sm_header'             => 'sometimes',
            'selected_theme'                => 'sometimes',
            'commission_type'               => 'sometimes|in:commission,subscription',
            'live_chat'                     => 'sometimes',
            'show_provider_contact_info'    => 'sometimes',
            'theme_one_color'               => 'sometimes',
            'theme_two_color'               => 'sometimes',
            'theme_three_color'             => 'sometimes',
        ], [
            'app_name.required'                   => __('App name is required'),
            'timezone.required'                   => __('Timezone is required'),
            'is_queable.required'                 => __('Queue is required'),
            'contact_message_receiver_mail.email' => __('The contact message receiver mail must be a valid email address.'),
            'is_queable.in'                       => __('Queue is invalid'),
            'comments_auto_approved.in'           => __('Review auto approved is invalid'),
            'search_engine_indexing.in'           => __('Search engine crawling is invalid'),
        ]);

        foreach ($request->except('_token') as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        Cache::forget('setting');
        Cache::forget('corn_working');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_logo_favicon(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        if ($request->file('logo')) {
            $file_name = saveFileGetPath($request->logo, 'uploads/custom-images/', $this->cachedSetting?->logo);
            Setting::where('key', 'logo')->update(['value' => $file_name]);
        }

        if ($request->file('favicon')) {
            $file_name = saveFileGetPath($request->favicon, 'uploads/custom-images/', $this->cachedSetting?->favicon);
            Setting::where('key', 'favicon')->update(['value' => $file_name]);
        }

        if ($request->file('footer_logo')) {
            $file_name = saveFileGetPath($request->footer_logo, 'uploads/custom-images/', $this->cachedSetting?->footer_logo);
            Setting::where('key', 'footer_logo')->update(['value' => $file_name]);
        }

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_cookie_consent(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'cookie_status'    => 'required',
            'border'           => 'required',
            'corners'          => 'required',
            'background_color' => 'required',
            'text_color'       => 'required',
            'border_color'     => 'required',
            'btn_bg_color'     => 'required',
            'btn_text_color'   => 'required',
            'link_text'        => 'required',
            'btn_text'         => 'required',
            'message'          => 'required',
        ], [
            'cookie_status.required'    => __('Status is required'),
            'border.required'           => __('Border is required'),
            'corners.required'          => __('Corner is required'),
            'background_color.required' => __('Background color is required'),
            'text_color.required'       => __('Text color is required'),
            'border_color.required'     => __('Border Color is required'),
            'btn_bg_color.required'     => __('Button color is required'),
            'btn_text_color.required'   => __('Button text color is required'),
            'link_text.required'        => __('Link text is required'),
            'btn_text.required'         => __('Button text is required'),
            'message.required'          => __('Message is required'),
        ]);

        Setting::where('key', 'cookie_status')->update(['value' => $request->cookie_status]);
        Setting::where('key', 'border')->update(['value' => $request->border]);
        Setting::where('key', 'corners')->update(['value' => $request->corners]);
        Setting::where('key', 'background_color')->update(['value' => $request->background_color]);
        Setting::where('key', 'text_color')->update(['value' => $request->text_color]);
        Setting::where('key', 'border_color')->update(['value' => $request->border_color]);
        Setting::where('key', 'btn_bg_color')->update(['value' => $request->btn_bg_color]);
        Setting::where('key', 'btn_text_color')->update(['value' => $request->btn_text_color]);
        Setting::where('key', 'link_text')->update(['value' => $request->link_text]);
        Setting::where('key', 'btn_text')->update(['value' => $request->btn_text]);
        Setting::where('key', 'message')->update(['value' => $request->message]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_custom_pagination(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        foreach ($request->quantities as $index => $quantity) {
            if ($request->quantities[$index] == '') {
                $notification = [
                    'message'    => __('Every field are required'),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            $custom_pagination      = CustomPagination::find($request->ids[$index]);
            $custom_pagination->qty = $request->quantities[$index];
            $custom_pagination->save();
        }

        // Cache update
        $custom_pagination = CustomPagination::all();
        $pagination        = [];
        foreach ($custom_pagination as $item) {
            $pagination[str_replace(' ', '_', strtolower($item->section_name))] = $item->item_qty;
        }
        $pagination = (object) $pagination;
        Cache::put('CustomPagination', $pagination);

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function update_default_avatar(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        if ($request->file('default_avatar')) {
            $file_name = saveFileGetPath($request->default_avatar, 'uploads/custom-images/', $this->cachedSetting?->default_avatar);
            Setting::where('key', 'default_avatar')->update(['value' => $file_name]);
        }

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function update_breadcrumb(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        if ($request->file('breadcrumb_image')) {
            $file_name = saveFileGetPath($request->breadcrumb_image, 'uploads/custom-images/', $this->cachedSetting?->breadcrumb_image);
            Setting::where('key', 'breadcrumb_image')->update(['value' => $file_name]);
        }

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_copyright_text(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'copyright_text' => 'required',
        ], [
            'copyright_text' => __('Copyright Text is required'),
        ]);
        Setting::where('key', 'copyright_text')->update(['value' => $request->copyright_text]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @return mixed
     */
    public function crediential_setting()
    {
        checkAdminHasPermissionAndThrowException('setting.view');

        $facebookComment = FacebookComment::first();

        return view('globalsetting::credientials.index', [
            'facebookComment' => $facebookComment,
        ]);
    }

    /**
     * @param Request $request
     */
    public function updateBlogComment(Request $request)
    {
        $rules = [
            'comment_type' => 'required',
            'app_id'       => $request->comment_type == 0 ? 'required' : '',
        ];
        $customMessages = [
            'app_id.required' => trans('admin_validation.App id is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $facebookComment               = FacebookComment::first();
        $facebookComment->comment_type = $request->comment_type;
        $facebookComment->app_id       = $request->app_id;
        $facebookComment->save();

        $notification = trans('Update Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_google_captcha(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'recaptcha_site_key'   => 'required',
            'recaptcha_secret_key' => 'required',
            'recaptcha_status'     => 'required',
        ], [
            'recaptcha_site_key.required'   => __('Site key is required'),
            'recaptcha_secret_key.required' => __('Secret key is required'),
            'recaptcha_status.required'     => __('Status is required'),
        ]);

        Setting::where('key', 'recaptcha_site_key')->update(['value' => $request->recaptcha_site_key]);
        Setting::where('key', 'recaptcha_secret_key')->update(['value' => $request->recaptcha_secret_key]);
        Setting::where('key', 'recaptcha_status')->update(['value' => $request->recaptcha_status]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_google_tag(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'googel_tag_status' => 'required',
            'googel_tag_id'     => 'required',
        ], [
            'googel_tag_status.required' => __('Status is required'),
            'googel_tag_id.required'     => __('Google Tag ID is required'),
        ]);

        Setting::where('key', 'googel_tag_status')->update(['value' => $request->googel_tag_status]);
        Setting::where('key', 'googel_tag_id')->update(['value' => $request->googel_tag_id]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_tawk_chat(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'live_chat'      => 'required',
            'tawk_status'    => 'required',
            'tawk_chat_link' => 'required',
        ], [
            'live_chat.required'      => __('Live chat is required'),
            'tawk_status.required'    => __('Status is required'),
            'tawk_chat_link.required' => __('Chat link is required'),
        ]);
        if (strpos($request->tawk_chat_link, 'embed.tawk.to') !== false) {
            $embedUrl = $request->tawk_chat_link;
        } elseif (strpos($request->tawk_chat_link, 'tawk.to/chat') !== false) {
            $embedUrl = str_replace('tawk.to/chat', 'embed.tawk.to', $request->tawk_chat_link);
        } else {
            $embedUrl = 'https://embed.tawk.to/' . $request->tawk_chat_link;
        }

        Setting::where('key', 'tawk_status')->update(['value' => $request->tawk_status]);
        Setting::where('key', 'tawk_chat_link')->update(['value' => $embedUrl]);
        Setting::where('key', 'live_chat')->update(['value' => $request->live_chat]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_google_analytic(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'google_analytic_status' => 'required',
            'google_analytic_id'     => 'required',
        ], [
            'google_analytic_status.required' => __('Status is required'),
            'google_analytic_id.required'     => __('Analytic id is required'),
        ]);

        Setting::where('key', 'google_analytic_status')->update(['value' => $request->google_analytic_status]);
        Setting::where('key', 'google_analytic_id')->update(['value' => $request->google_analytic_id]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_facebook_pixel(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $request->validate([
            'pixel_status' => 'required',
            'pixel_app_id' => 'required',
        ], [
            'pixel_status.required' => __('Status is required'),
            'pixel_app_id.required' => __('App ID is required'),
        ]);

        Setting::where('key', 'pixel_status')->update(['value' => $request->pixel_status]);
        Setting::where('key', 'pixel_app_id')->update(['value' => $request->pixel_app_id]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_social_login(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $rules = [
            'is_gmail'           => 'required',
            'is_facebook'        => 'required',
            'gmail_client_id'    => 'required',
            'gmail_secret_id'    => 'required',
            'facebook_client_id' => 'required',
            'facebook_secret_id' => 'required',
        ];

        $customMessages = [
            'is_gmail.required'           => __('Google is required'),
            'is_facebook.required'        => __('Facebook is required'),
            'gmail_client_id.required'    => __('Google client is required'),
            'gmail_secret_id.required'    => __('Google secret is required'),
            'facebook_client_id.required' => __('Facebook client is required'),
            'facebook_secret_id.required' => __('Facebook client is required'),
        ];

        $request->validate($rules, $customMessages);

        $socialCred = SocialLoginInformation::first();

        $socialCred->update(['is_facebook' => $request->is_facebook]);
        $socialCred->update(['facebook_client_id' => $request->facebook_client_id]);
        $socialCred->update(['facebook_secret_id' => $request->facebook_secret_id]);
        $socialCred->update(['is_gmail' => $request->is_gmail]);
        $socialCred->update(['gmail_client_id' => $request->gmail_client_id]);
        $socialCred->update(['gmail_secret_id' => $request->gmail_secret_id]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function update_pusher(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        $request->validate([
            'pusher_status'      => 'required',
            'pusher_app_id'      => 'required',
            'pusher_app_key'     => 'required',
            'pusher_app_secret'  => 'required',
            'pusher_app_cluster' => 'required',
        ], [
            'pusher_status.required'      => __('Status is required'),
            'pusher_app_id.required'      => __('Pusher App ID is required'),
            'pusher_app_key.required'     => __('Pusher App Key is required'),
            'pusher_app_secret.required'  => __('Pusher App Secret is required'),
            'pusher_app_cluster.required' => __('Pusher App Cluster is required'),
        ]);

        Setting::where('key', 'pusher_status')->update(['value' => $request->pusher_status]);
        Setting::where('key', 'pusher_app_id')->update(['value' => $request->pusher_app_id]);
        Setting::where('key', 'pusher_app_key')->update(['value' => $request->pusher_app_key]);
        Setting::where('key', 'pusher_app_secret')->update(['value' => $request->pusher_app_secret]);
        Setting::where('key', 'pusher_app_cluster')->update(['value' => $request->pusher_app_cluster]);

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function seo_setting()
    {
        checkAdminHasPermissionAndThrowException('setting.view');
        $pages = SeoSetting::all();

        return view('globalsetting::seo_setting', compact('pages'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update_seo_setting(Request $request, $id)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $rules = [
            'seo_title'       => 'required',
            'seo_description' => 'required',
        ];
        $customMessages = [
            'seo_title.required'       => __('SEO title is required'),
            'seo_description.required' => __('SEO description is required'),
        ];
        $request->validate($rules, $customMessages);

        $page                  = SeoSetting::find($id);
        $page->seo_title       = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        Cache::forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);

    }

    public function cache_clear()
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        return view('globalsetting::cache_clear');
    }

    public function cache_clear_confirm()
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        Artisan::call('optimize:clear');

        $notification = __('Cache cleared successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function database_clear()
    {
        checkAdminHasPermissionAndThrowException('setting.view');

        return view('globalsetting::database_clear');
    }

    /**
     * @param Request $request
     */
    public function database_clear_success(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        $request->validate(['password' => 'required'], ['password.required' => __('Password is required')]);

        if (Hash::check($request->password, auth('admin')->user()->password)) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            try {

                AppointmentSchedule::truncate();
                AdditionalService::truncate();
                Blog::truncate();
                BlogComment::truncate();
                BlogCategory::truncate();
                Category::truncate();
                CategoryTranslation::truncate();
                City::truncate();
                CompleteRequest::truncate();
                ContactMessage::truncate();
                Country::truncate();
                CountryState::truncate();
                Coupon::truncate();
                CouponHistory::truncate();
                CustomizeablePage::truncate();
                CustomizablePageTranslation::truncate();
                Faq::truncate();
                FaqTranslation::truncate();
                JobPost::truncate();
                JobPostTranslation::truncate();
                JobRequest::truncate();
                KycInformation::truncate();
                Message::truncate();
                MessageDocument::truncate();
                NewsLetter::truncate();
                Order::truncate();
                Partner::truncate();
                PopularPost::truncate();
                ProviderClientReport::truncate();
                ProviderPaymentGateway::truncate();
                PurchaseHistory::truncate();
                RefundRequest::truncate();
                Review::truncate();
                Schedule::truncate();
                Service::truncate();
                ServiceArea::truncate();
                SubscriptionPlan::truncate();
                Ticket::truncate();
                TicketMessage::truncate();
                User::truncate();
                Testimonial::truncate();
                ProviderWithdraw::truncate();

                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            } catch (\Exception $e) {
                logger($e);
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                $notification = __('Database Clear Failed');
                $notification = ['message' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }

            Artisan::call('optimize:clear');

            $notification = __('Database Cleared Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];

        } else {
            $notification = __('Passwords do not match.');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
        }

        return redirect()->back()->with($notification);

    }

    /**
     * @param $type
     */
    public function customCode($type)
    {
        checkAdminHasPermissionAndThrowException('setting.view');
        $customCode = CustomCode::first();
        if (!$customCode) {
            $customCode                    = new CustomCode();
            $customCode->css               = '//write your css code here without the style tag';
            $customCode->header_javascript = '//write your javascript here without the script tag';
            $customCode->body_javascript   = '//write your javascript here without the script tag';
            $customCode->footer_javascript = '//write your javascript here without the script tag';
            $customCode->save();
        }

        return view('globalsetting::custom_code_' . $type, compact('customCode'));
    }

    /**
     * @param Request $request
     */
    public function customCodeUpdate(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $validatedData = $request->validate([
            'css'               => 'sometimes',
            'header_javascript' => 'sometimes',
            'body_javascript'   => 'sometimes',
            'footer_javascript' => 'sometimes',
        ]);

        $customCode = CustomCode::firstOrNew();
        $customCode->fill($validatedData);
        $customCode->save();

        Cache::forget('customCode');

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function update_maintenance_mode_status()
    {
        checkAdminHasPermissionAndThrowException('setting.update');
        $status = $this->cachedSetting?->maintenance_mode == 1 ? 0 : 1;

        Setting::where('key', 'maintenance_mode')->update(['value' => $status]);

        Cache::forget('setting');
        Cache::forget('maintenance');

        return response()->json([
            'success' => true,
            'message' => __('Updated Successfully'),
        ]);
    }

    /**
     * @param Request $request
     */
    public function update_maintenance_mode(Request $request)
    {
        checkAdminHasPermissionAndThrowException('setting.update');

        $request->validate([
            'maintenance_image'       => 'nullable|image',
            'maintenance_title'       => 'required',
            'maintenance_description' => 'required',
        ], [
            'maintenance_image'       => __('Maintenance Mode Image is required'),
            'maintenance_title'       => __('Maintenance Mode Title is required'),
            'maintenance_description' => __('Maintenance Mode Description is required'),
        ]);

        if ($request->hasFile('maintenance_image')) {
            $file_name = saveFileGetPath($request->maintenance_image, 'uploads/custom-images/', $this->cachedSetting?->maintenance_image);
            Setting::where('key', 'maintenance_image')->update(['value' => $file_name]);
        }

        Setting::where('key', 'maintenance_title')->update(['value' => $request->maintenance_title]);
        Setting::where('key', 'maintenance_description')->update(['value' => $request->maintenance_description]);

        Cache::forget('setting');
        Cache::forget('maintenance');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function systemUpdate()
    {
        $zipLoaded = extension_loaded('zip');

        $updateFileDetails = false;
        $files             = false;
        $uploadFileSize    = false;

        $zipFilePath = public_path('upload/update.zip');
        if ($updateFileDetails = File::exists($zipFilePath)) {
            $uploadFileSize = File::size($zipFilePath);

            $files = $this->getFilesFromZip($zipFilePath);
        }

        return view('globalsetting::auto-update', compact('updateFileDetails', 'uploadFileSize', 'files', 'zipLoaded'));
    }

    /**
     * @param Request $request
     */
    public function systemUpdateStore(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip',
        ]);
        $zipFile = $request->file('zip_file');

        // Get the file size in bytes
        $fileSize = $zipFile->getSize();
        // Fetch server max upload size and post max size
        $max_upload_size = $this->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
        $max_post_size   = $this->convertPHPSizeToBytes(ini_get('post_max_size'));
        // Get the smaller of the two values
        $max_size = min($max_upload_size, $max_post_size);

        if ($fileSize > $max_size) {
            $notification = __("The uploaded file exceeds the server's maximum upload size of ") . $this->formatBytes($max_size);
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $zipFilePath = public_path('upload/update.zip');

        if (File::exists($zipFilePath)) {
            File::delete($zipFilePath);
        }

        // Store the uploaded file
        $zipFilePath = $zipFile->move(public_path('upload'), 'update.zip');

        if (!$this->isFirstDirUpload($zipFilePath)) {
            File::delete($zipFilePath);
            $notification = __('Invalid Update File Structure');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        return back();
    }
    /**
     * @param  $size
     * @return mixed
     */
    private function convertPHPSizeToBytes($size)
    {
        $suffix = strtoupper(substr($size, -1));
        $value  = (int) substr($size, 0, -1);
        switch ($suffix) {
            case 'G':
                $value *= 1024 * 1024 * 1024;
                break;
            case 'M':
                $value *= 1024 * 1024;
                break;
            case 'K':
                $value *= 1024;
                break;
        }
        return $value;
    }
    /**
     * @param $size
     * @param $precision
     */
    private function formatBytes($size, $precision = 2)
    {
        $units         = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index         = floor(log($size, 1024));
        $formattedSize = $size / pow(1024, $index);
        return round($formattedSize, $precision) . ' ' . $units[$index];
    }

    public function systemUpdateRedirect()
    {
        $zipFilePath = public_path('upload/update.zip');

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath) !== true) {
            File::delete($zipFilePath);
            $notification = __('Corrupted Zip File');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            $zip->close();
            return redirect()->back()->with($notification);
        }

        if (!$this->isFirstDirUpload($zipFilePath)) {
            $notification = __('Invalid Update File Structure');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            $zip->close();
            return redirect()->back()->with($notification);
        }

        $zip->close();

        $this->deleteFolderAndFiles(base_path('update'));

        if ($zip->open($zipFilePath) === true) {
            $zip->extractTo(base_path());
            $zip->close();
        }

        return redirect(url('/update'));
    }

    public function systemUpdateDelete()
    {
        $zipFilePath = public_path('upload/update.zip');
        File::delete($zipFilePath);

        $this->deleteFolderAndFiles(base_path('update'));

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return back()->with($notification);
    }

    /**
     * @param  $zipFilePath
     * @return mixed
     */
    private function getFilesFromZip($zipFilePath)
    {
        $files = [];
        $zip   = new ZipArchive;
        if ($zip->open($zipFilePath) === true) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileInfo = $zip->statIndex($i);
                $files[]  = $fileInfo['name'];
            }
        }
        $zip->close();
        return $files;
    }

    /**
     * @param  $dir
     * @return null
     */
    private function deleteFolderAndFiles($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir . '/' . $file;

            if (is_dir($path)) {
                $this->deleteFolderAndFiles($path);
            } else {
                unlink($path);
            }
        }

        rmdir($dir);
    }

    /**
     * @param  $zipFilePath
     * @return mixed
     */
    private function isFirstDirUpload($zipFilePath)
    {
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath) === true) {
            $firstDir = null;

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileInfo      = $zip->statIndex($i);
                $filePathParts = explode('/', $fileInfo['name']);

                if (count($filePathParts) > 1) {
                    $firstDir = $filePathParts[0];
                    break;
                }
            }

            $zip->close();
            return $firstDir === "update";
        }

        $zip->close();
        return false;
    }
}
