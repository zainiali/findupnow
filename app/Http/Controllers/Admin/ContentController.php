<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionContent;
use App\Models\SectionControl;
use App\Models\SeoSetting;
use App\Models\Setting;
use App\Models\SettingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\GlobalSetting\app\Models\Setting as GlobalSetting;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class ContentController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function headerPhoneNumber()
    {
        return view('admin.website-content.header_phone_number');
    }

    /**
     * @param Request $request
     */
    public function updateHeaderPhoneNumber(Request $request)
    {
        $rules = [
            'topbar_phone' => 'required',
            'topbar_email' => 'required',
            'opening_time' => 'required',
        ];

        $customMessages = [
            'topbar_phone.required' => __('Header phone is required'),
            'topbar_email.required' => __('Header email is required'),
            'opening_time.required' => __('Opening time is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        GlobalSetting::where('key', 'topbar_phone')->update([
            'value' => $request->topbar_phone,
        ]);

        GlobalSetting::where('key', 'topbar_email')->update([
            'value' => $request->topbar_email,
        ]);

        GlobalSetting::where('key', 'opening_time')->update([
            'value' => $request->opening_time,
        ]);

        cache()->forget('setting');

        $setting               = Setting::first();
        $setting->topbar_phone = $request->topbar_phone;
        $setting->topbar_email = $request->topbar_email;
        $setting->opening_time = $request->opening_time;
        $setting->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @return null
     */
    public function joinAsAProvider()
    {
        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        $setting = Setting::first();

        if (!SettingTranslation::where(['lang_code' => $code, 'setting_id' => 1])->first()) {
            $setting_translation                           = new SettingTranslation();
            $setting_translation->lang_code                = $code;
            $setting_translation->setting_id               = 1;
            $setting_translation->join_as_a_provider_title = $setting->getTranslation('en')->join_as_a_provider_title;
            $setting_translation->join_as_a_provider_btn   = $setting->getTranslation('en')->join_as_a_provider_btn;
            $setting_translation->save();
        }

        $join_as_a_provider = [
            'image'       => $setting->join_as_a_provider_banner,
            'home3_image' => $setting->home3_join_as_provider,
            'home2_image' => $setting->home2_join_as_provider,
            'title'       => $setting->getTranslation($code)->join_as_a_provider_title,
            'button_text' => $setting->getTranslation($code)->join_as_a_provider_btn,
        ];
        $join_as_a_provider = (object) $join_as_a_provider;

        $selected_theme = $setting->selected_theme;

        $languages = Language::all();

        return view('admin.website-content.join_as_a_provider', compact('join_as_a_provider', 'selected_theme', 'languages', 'code'));
    }

    /**
     * @param Request $request
     */
    public function updatejoinAsAProvider(Request $request)
    {
        $rules = [
            'title'       => 'required',
            'button_text' => 'required',
            'code'        => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'button_text.required' => __('Button text is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $setting                           = SettingTranslation::where(['lang_code' => $request->code, 'setting_id' => 1])->first();
        $setting->join_as_a_provider_title = $request->title;
        $setting->join_as_a_provider_btn   = $request->button_text;
        $setting->save();

        $setting = Setting::first();
        if ($request->hasFile('image')) {
            $setting->join_as_a_provider_banner = saveFileGetPath($request->image, oldFile: $setting->join_as_a_provider_banner);
            $setting->save();
        }

        if ($request->hasFile('image2')) {
            $setting->home2_join_as_provider = saveFileGetPath($request->image2, oldFile: $setting->home2_join_as_provider);
            $setting->save();
        }

        if ($request->hasFile('image3')) {
            $setting->home3_join_as_provider = saveFileGetPath($request->image3, oldFile: $setting->home3_join_as_provider);
            $setting->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function mobileApp()
    {
        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        $setting = Setting::first();

        if (!SettingTranslation::where(['lang_code' => $code, 'setting_id' => 1])->first()) {
            $setting_translation                  = new SettingTranslation();
            $setting_translation->lang_code       = $code;
            $setting_translation->setting_id      = 1;
            $setting_translation->app_short_title = $setting->getTranslation('en')->app_short_title;
            $setting_translation->app_full_title  = $setting->getTranslation('en')->app_full_title;
            $setting_translation->app_description = $setting->getTranslation('en')->app_description;
            $setting_translation->save();
        }

        $mobile_app = [
            'short_title'     => $setting->getTranslation($code)->app_short_title,
            'full_title'      => $setting->getTranslation($code)->app_full_title,
            'description'     => $setting->getTranslation($code)->app_description,
            'play_store'      => $setting->google_playstore_link,
            'app_store'       => $setting->app_store_link,
            'image'           => $setting->app_image,
            'home2_app_image' => $setting->home2_app_image,
            'home3_app_image' => $setting->home3_app_image,
        ];
        $mobile_app = (object) $mobile_app;

        $selected_theme = $setting->selected_theme;

        $languages = Language::all();

        return view('admin.website-content.mobile_app', compact('mobile_app', 'selected_theme', 'languages', 'code'));
    }

    /**
     * @param Request $request
     */
    public function updateMobileApp(Request $request)
    {
        $rules = [
            'short_title' => 'required',
            'full_title'  => 'required',
            'description' => 'required',
            'play_store'  => 'required',
            'app_store'   => 'required',
            'code'        => 'required',
        ];
        $customMessages = [
            'short_title.required' => __('Short title is required'),
            'full_title.required'  => __('Title is required'),
            'description.required' => __('Description is required'),
            'play_store.required'  => __('Play store is required'),
            'app_store.required'   => __('App store is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $setting                  = SettingTranslation::where(['lang_code' => $request->code, 'setting_id' => 1])->first();
        $setting->app_short_title = $request->short_title;
        $setting->app_full_title  = $request->full_title;
        $setting->app_description = $request->description;
        $setting->save();

        $setting                        = Setting::first();
        $setting->google_playstore_link = $request->play_store;
        $setting->app_store_link        = $request->app_store;
        $setting->save();

        if ($request->hasFile('image')) {
            $setting->app_image = saveFileGetPath($request->image, oldFile: $setting->app_image);
            $setting->save();
        }

        if ($request->hasFile('image2')) {
            $setting->home2_app_image = saveFileGetPath($request->image2, oldFile: $setting->home2_app_image);
            $setting->save();
        }

        if ($request->hasFile('image3')) {
            $setting->home3_app_image = saveFileGetPath($request->image3, oldFile: $setting->home3_app_image);
            $setting->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function subscriberSection()
    {
        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        $setting = Setting::first();

        if (!SettingTranslation::where(['lang_code' => $code, 'setting_id' => 1])->first()) {
            $setting_translation                         = new SettingTranslation();
            $setting_translation->lang_code              = $code;
            $setting_translation->setting_id             = 1;
            $setting_translation->subscriber_title       = $setting->getTranslation('en')->subscriber_title;
            $setting_translation->subscriber_description = $setting->getTranslation('en')->subscriber_description;
            $setting_translation->save();
        }

        $subscriber = [
            'title'                        => $setting->getTranslation($code)->subscriber_title,
            'description'                  => $setting->getTranslation($code)->subscriber_description,
            'image'                        => $setting->subscriber_image,
            'background_image'             => $setting->subscription_bg,
            'home2_background_image'       => $setting->home2_subscription_bg,
            'home3_background_image'       => $setting->home3_subscription_bg,
            'blog_page_subscription_image' => $setting->blog_page_subscription_image,
        ];
        $subscriber = (object) $subscriber;

        $selected_theme = $setting->selected_theme;

        $languages = Language::all();

        return view('admin.website-content.subscriber_section', compact('subscriber', 'selected_theme', 'languages', 'code'));
    }

    /**
     * @param Request $request
     */
    public function updateSubscriberSection(Request $request)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'code'        => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $setting                         = SettingTranslation::where(['lang_code' => $request->code, 'setting_id' => 1])->first();
        $setting->subscriber_title       = $request->title;
        $setting->subscriber_description = $request->description;
        $setting->save();

        $setting = Setting::first();

        if ($request->hasFile('image')) {
            $setting->subscriber_image = saveFileGetPath($request->file('image'), oldFile: $setting->subscriber_image);
        }

        if ($request->hasFile('background_image')) {
            $setting->subscription_bg = saveFileGetPath($request->file('background_image'), oldFile: $setting->subscription_bg);
        }

        if ($request->hasFile('background_image2')) {
            $setting->home2_subscription_bg = saveFileGetPath($request->file('background_image2'), oldFile: $setting->home2_subscription_bg);
        }

        if ($request->hasFile('background_image3')) {
            $setting->home3_subscription_bg = saveFileGetPath($request->file('background_image3'), oldFile: $setting->home3_subscription_bg);
        }

        if ($request->hasFile('blog_page_subscription_image')) {
            $setting->blog_page_subscription_image = saveFileGetPath($request->file('blog_page_subscription_image'), oldFile: $setting->blog_page_subscription_image);
        }

        $setting->save();
        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function home2Contact()
    {
        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        $setting = Setting::first();

        if (!SettingTranslation::where(['lang_code' => $code, 'setting_id' => 1])->first()) {
            $setting_translation                                 = new SettingTranslation();
            $setting_translation->lang_code                      = $code;
            $setting_translation->setting_id                     = 1;
            $setting_translation->home2_contact_call_as          = $setting->getTranslation('en')->home2_contact_call_as;
            $setting_translation->home2_contact_available        = $setting->getTranslation('en')->home2_contact_available;
            $setting_translation->home2_contact_form_title       = $setting->getTranslation('en')->home2_contact_form_title;
            $setting_translation->home2_contact_form_description = $setting->getTranslation('en')->home2_contact_form_description;
            $setting_translation->save();
        }

        $contact = (object) [
            'foreground'       => $setting->home2_contact_foreground,
            'background'       => $setting->home2_contact_background,
            'call_as_now'      => $setting->getTranslation($code)->home2_contact_call_as,
            'phone'            => $setting->home2_contact_phone,
            'available_time'   => $setting->getTranslation($code)->home2_contact_available,
            'form_title'       => $setting->getTranslation($code)->home2_contact_form_title,
            'form_description' => $setting->getTranslation($code)->home2_contact_form_description,
        ];

        $languages = Language::all();

        return view('admin.website-content.home2_contact', compact('contact', 'languages', 'code'));

    }

    /**
     * @param Request $request
     */
    public function updateHome2Contact(Request $request)
    {
        $rules = [
            'call_as_now'      => 'required',
            'phone'            => 'required',
            'available_time'   => 'required',
            'form_title'       => 'required',
            'form_description' => 'required',
            'code'             => 'required',
        ];
        $customMessages = [
            'call_as_now.required'      => __('Call as now is required'),
            'phone.required'            => __('Phone is required'),
            'available_time.required'   => __('Available time is required'),
            'form_title.required'       => __('Form title is required'),
            'form_description.required' => __('Form description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $setting = SettingTranslation::where(['lang_code' => $request->code, 'setting_id' => 1])->first();

        $setting->home2_contact_call_as          = $request->call_as_now;
        $setting->home2_contact_available        = $request->available_time;
        $setting->home2_contact_form_title       = $request->form_title;
        $setting->home2_contact_form_description = $request->form_description;
        $setting->save();

        $setting                      = Setting::first();
        $setting->home2_contact_phone = $request->phone;
        $setting->save();

        if ($request->hasFile('image')) {
            $setting->home2_contact_foreground = saveFileGetPath($request->image, oldFile: $setting->home2_contact_foreground);
            $setting->save();
        }

        if ($request->hasFile('background_image')) {
            $setting->home2_contact_background = saveFileGetPath($request->background_image, oldFile: $setting->home2_contact_background);
            $setting->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function howItWork()
    {
        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        $setting = Setting::first();

        if (!SettingTranslation::where(['lang_code' => $code, 'setting_id' => 1])->first()) {
            $setting_translation                          = new SettingTranslation();
            $setting_translation->lang_code               = $code;
            $setting_translation->setting_id              = 1;
            $setting_translation->how_it_work_title       = $setting->getTranslation('en')->how_it_work_title;
            $setting_translation->how_it_work_description = $setting->getTranslation('en')->how_it_work_description;
            $setting_translation->how_it_work_items       = $setting->getTranslation('en')->how_it_work_items;
            $setting_translation->save();
        }

        $how_it_work = (object) [
            'background'  => $setting->how_it_work_background,
            'foreground'  => $setting->how_it_work_foreground,
            'title'       => $setting->getTranslation($code)->how_it_work_title,
            'description' => $setting->getTranslation($code)->how_it_work_description,
            'items'       => json_decode($setting->getTranslation($code)->how_it_work_items),
        ];

        $languages = Language::all();

        return view('admin.website-content.how_it_work', compact('how_it_work', 'languages', 'code'));
    }

    /**
     * @param Request $request
     */
    public function updateHowItWork(Request $request)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'code'        => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $settingTrans                          = SettingTranslation::where(['lang_code' => $request->code, 'setting_id' => 1])->first();
        $settingTrans->how_it_work_title       = $request->title;
        $settingTrans->how_it_work_description = $request->description;
        $settingTrans->save();

        $setting = Setting::first();
        if ($request->image) {
            $setting->how_it_work_foreground = saveFileGetPath($request->image, oldFile: $setting->how_it_work_foreground);
            $setting->save();
        }

        if ($request->background_image) {
            $setting->how_it_work_background = saveFileGetPath($request->background_image, oldFile: $setting->how_it_work_background);
            $setting->save();
        }

        $items = [];
        if ($request->titles && $request->descriptions) {
            foreach ($request->titles as $index => $title) {
                $item = [];
                if ($request->titles[$index] && $request->descriptions[$index]) {
                    $item = [
                        'title'       => $request->titles[$index],
                        'description' => $request->descriptions[$index],
                    ];

                    $items[] = $item;
                }
            }
        }

        $items                           = json_encode($items);
        $settingTrans->how_it_work_items = $items;
        $settingTrans->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function sectionContent()
    {
        $contents = SectionContent::all();

        $languages = Language::all();

        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        return view('admin.website-content.section_content', compact('contents', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateSectionContent(Request $request, $id)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
        ];

        $customMessages = [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
        ];

        $request->validate($rules, $customMessages);

        $section = SectionContent::findOrFail($id);

        $validated = Validator::make($request->all(), $rules, $customMessages);

        $this->updateTranslations($section, $request, $validated->validated());

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function sectionControl()
    {
        $homepage = SectionControl::get();

        return view('admin.website-content.section_control', compact('homepage'));
    }

    /**
     * @param Request $request
     */
    public function updateSectionControl(Request $request)
    {
        foreach ($request->ids as $index => $id) {
            $section         = SectionControl::find($id);
            $section->status = $request->status[$index];
            $section->qty    = $request->quanities[$index];
            $section->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function seoSetup()
    {
        $pages = SeoSetting::all();
        return view('admin.website-content.seo_setup', compact('pages'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateSeoSetup(Request $request, $id)
    {
        $rules = [
            'seo_title'       => 'required',
            'seo_description' => 'required',
        ];
        $customMessages = [
            'seo_title.required'       => __('Seo title is required'),
            'seo_description.required' => __('Seo description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $page                  = SeoSetting::find($id);
        $page->seo_title       = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    public function defaultAvatar()
    {
        $setting = Setting::first();

        $default_avatar = $setting->default_avatar;

        return view('admin.website-content.default_profile_image', compact('default_avatar'));
    }

    /**
     * @param Request $request
     */
    public function updateDefaultAvatar(Request $request)
    {
        $setting = Setting::first();

        $gSetting = GlobalSetting::where('key', 'default_avatar')->first();

        $notification = __('Update unsuccessfully');

        if ($request->hasFile('avatar')) {
            $setting->default_avatar = saveFileGetPath($request->avatar, oldFile: $setting->default_avatar);
            $setting->save();

            $gSetting->value = $setting->default_avatar;
            $gSetting->save();
            $notification = __('Update Successfully');
        }

        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function login_page()
    {
        $setting    = Setting::first();
        $login_page = [
            'image' => $setting->login_image,
        ];
        $login_page = (object) $login_page;
        return view('admin.website-content.login_page', compact('login_page'));
    }

    /**
     * @param Request $request
     */
    public function update_login_page(Request $request)
    {
        $setting = Setting::first();

        $notification = __('Update unsuccessful');

        if ($request->hasFile('image')) {
            $setting->login_image = saveFileGetPath($request->image, oldFile: $setting->login_image);
            $setting->save();
            $notification = __('Update Successfully');
        }

        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
