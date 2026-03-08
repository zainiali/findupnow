<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BreadcrumbImage;
use Illuminate\Http\Request;
use Image;

class BreadcrumbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $images = BreadcrumbImage::orderBy('id', 'asc')->get();
        return view('admin.website-content.breadcrumb_image', compact('images'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'image' => 'required',
        ];
        $this->validate($request, $rules);
        $image = BreadcrumbImage::find($id);
        if ($request->hasFile('image')) {
            $image->image = saveFileGetPath($request->image, oldFile: $image->image);
            $image->save();
        }

        $notification = 'Updated Successfully';
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
