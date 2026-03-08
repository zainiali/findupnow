<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $links       = FooterLink::where('column', 1)->get();
        $column      = 1;
        $title       = __('First Column Link');
        $footer      = Footer::first();
        $columnTitle = $footer->first_column;
        return view('admin.footer_link', compact('links', 'column', 'title', 'columnTitle'));
    }

    public function secondColFooterLink()
    {
        $links       = FooterLink::where('column', 2)->get();
        $column      = 2;
        $title       = __('Second Column Link');
        $footer      = Footer::first();
        $columnTitle = $footer->second_column;
        return view('admin.footer_link', compact('links', 'column', 'title', 'columnTitle'));
    }

    public function thirdColFooterLink()
    {
        $links       = FooterLink::where('column', 3)->get();
        $column      = 3;
        $title       = __('Third Column Link');
        $footer      = Footer::first();
        $columnTitle = $footer->third_column;
        return view('admin.footer_link', compact('links', 'column', 'title', 'columnTitle'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'link' => 'required',
            'name' => 'required',
        ];
        $customMessages = [
            'link.required' => __('Link is required'),
            'name.required' => __('Name is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $link         = new FooterLink();
        $link->link   = $request->link;
        $link->title  = $request->name;
        $link->column = $request->column;
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
            'name' => 'required',
            'link' => 'required',
        ];
        $customMessages = [
            'link.required' => __('Link is required'),
            'name.required' => __('Name is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $link        = FooterLink::find($id);
        $link->link  = $request->link;
        $link->title = $request->name;
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
        $link = FooterLink::find($id);
        $link->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateColTitle(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
        ];
        $customMessages = [
            'title.required' => __('Title is required'),
        ];
        $this->validate($request, $rules, $customMessages);
        $footer = Footer::first();
        if ($id == 1) {
            $footer->first_column = $request->title;
            $footer->save();
        } else if ($id == 2) {
            $footer->second_column = $request->title;
            $footer->save();
        } else if ($id == 3) {
            $footer->third_column = $request->title;
            $footer->save();
        }
        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

}
