<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $contact = ContactPage::first();
        return view('admin.contact_page', compact('contact'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'email'        => 'required',
            'phone'        => 'required',
            'address'      => 'required',
            'support_time' => 'required',
            'google_map'   => 'required',
            'off_day'      => 'required',
        ];
        $customMessages = [
            'email.required'      => __('Email is required'),
            'phone.unique'        => __('Phone is required'),
            'address.unique'      => __('Address is required'),
            'support_time.unique' => __('Support time is required'),
            'google_map.unique'   => __('Google Map is required'),
            'off_day.unique'      => __('Off day is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $contact = ContactPage::find($id);
        if ($request->supporter_image) {
            $exist_banner             = $contact->supporter_image;
            $contact->supporter_image = saveFileGetPath($request->supporter_image, oldFile: $exist_banner);
            $contact->save();
        }

        $contact->email        = $request->email;
        $contact->phone        = $request->phone;
        $contact->address      = $request->address;
        $contact->support_time = $request->support_time;
        $contact->map          = $request->google_map;
        $contact->off_day      = $request->off_day;
        $contact->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
