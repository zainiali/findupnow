<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ErrorPage;
use Illuminate\Http\Request;

class ErrorPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $errorPages = ErrorPage::all();
        return view('admin.custom-pages.error_page', compact('errorPages'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $errorPage = ErrorPage::find($id);

        $rules = [
            'page_name'   => 'required',
            'page_number' => 'required',
            'header'      => 'required',
            'button_text' => 'required',
            'description' => 'required',
        ];
        $customMessages = [
            'page_name.required'   => __('Page name is required'),
            'page_number.required' => __('Page number is required'),
            'header.required'      => __('Header is required'),
            'button_text.required' => __('Button text is required'),
            'description.required' => __('Description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $errorPage->page_name   = $request->page_name;
        $errorPage->page_number = $request->page_number;
        $errorPage->header      = $request->header;
        $errorPage->button_text = $request->button_text;
        $errorPage->description = $request->description;
        $errorPage->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
