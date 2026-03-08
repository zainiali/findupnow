<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Modules\GlobalSetting\app\Models\Setting as ModelsSetting;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $contactMessages = ContactMessage::all();
        $settings        = Setting::first();
        return view('admin.contact-message.contact_message', compact('contactMessages', 'settings'));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $contactMessage = ContactMessage::find($id);
        $contactMessage->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function handleSaveContactMessage(Request $request)
    {

        $rules = [
            'contact_email' => 'required',
        ];
        $customMessages = [
            'contact_email.required' => __('Contact email is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $setting                              = Setting::first();
        $setting->contact_email               = $request->contact_email;
        $setting->enable_save_contact_message = $request->enable_save_contact_message;
        $setting->save();

        ModelsSetting::where('key', 'contact_email')?->update(['value' => $request->contact_email]);
        ModelsSetting::where('key', 'enable_save_contact_message')?->update(['value' => $request->enable_save_contact_message]);

        cache()->forget('setting');

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
