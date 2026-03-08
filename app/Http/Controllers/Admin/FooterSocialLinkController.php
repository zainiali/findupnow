<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSocialLink;
use Illuminate\Http\Request;

class FooterSocialLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $links = FooterSocialLink::all();
        return view('admin.website-content.footer_social_link', compact('links'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'link' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'link.required' => __('Link is required'),
            'icon.required' => __('Icon is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $link       = new FooterSocialLink();
        $link->link = $request->link;
        $link->icon = $request->icon;
        $link->save();

        $notification = __('Create Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'link' => 'required',
            'icon' => 'required',
        ];
        $customMessages = [
            'link.required' => __('Link is required'),
            'icon.required' => __('Icon is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $link       = FooterSocialLink::find($id);
        $link->link = $request->link;
        $link->icon = $request->icon;
        $link->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $link = FooterSocialLink::find($id);
        $link->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
