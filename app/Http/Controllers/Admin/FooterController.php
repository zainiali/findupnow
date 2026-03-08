<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\FooterTranslation;
use Illuminate\Http\Request;
use Modules\Language\app\Models\Language;

class FooterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $footer = Footer::with('translation')->first();

        $code = request()->filled('code') ? request()->code : getSessionLanguage();

        $languages = Language::all();

        if (!FooterTranslation::where(['lang_code' => $code, 'footer_id' => $footer->id])->first()) {
            $setting_translation            = new FooterTranslation();
            $setting_translation->lang_code = $code;
            $setting_translation->footer_id = $footer->id;
            $setting_translation->address   = $footer->getTranslation('en')->address;
            $setting_translation->about_us  = $footer->getTranslation('en')->about_us;
            $setting_translation->copyright = $footer->getTranslation('en')->copyright;
            $setting_translation->save();
        }

        return view('admin.website-content.website_footer', compact('footer', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'copyright' => 'required',
            'about_us'  => 'required',
            'code'      => 'required',
        ];
        $customMessages = [
            'email.required'     => __('Email is required'),
            'phone.required'     => __('Phone is required'),
            'address.required'   => __('Address is required'),
            'copyright.required' => __('Copyright is required'),
            'about_us.required'  => __('About Us is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $footer        = Footer::first();
        $footer->email = $request->email;
        $footer->phone = $request->phone;

        $footerTrans            = FooterTranslation::where(['lang_code' => $request->code, 'footer_id' => $footer->id])->first();
        $footerTrans->address   = $request->address;
        $footerTrans->copyright = $request->copyright;
        $footerTrans->about_us  = $request->about_us;
        $footerTrans->save();

        if ($request->hasFile('card_image')) {
            $footer->payment_image = saveFileGetPath($request->card_image, oldFile: $footer->payment_image);
        }

        $footer->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
}
