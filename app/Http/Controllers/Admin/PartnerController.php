<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use File;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $partners = Partner::all();
        return view('admin.partner.partner', compact('partners'));
    }

    public function create()
    {
        return view('admin.partner.create_partner');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'logo' => 'required',
        ];
        $customMessages = [
            'logo.required' => __('Logo is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $partner = new Partner();
        if ($request->hasFile('logo')) {
            $partner->logo = saveFileGetPath($request->logo);
        }
        $partner->link   = $request->link;
        $partner->status = $request->status;
        $partner->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.partner.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('admin.partner.edit_partner', compact('partner'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::find($id);

        if ($request->hasFile('logo')) {
            $partner->logo = saveFileGetPath($request->logo, oldFile: $partner->logo);
            $partner->save();
        }

        $partner->link   = $request->link;
        $partner->status = $request->status;
        $partner->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.partner.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $partner  = Partner::find($id);
        $old_logo = $partner->logo;
        $partner->delete();
        if ($old_logo) {
            if (File::exists(public_path() . '/' . $old_logo)) {
                unlink(public_path() . '/' . $old_logo);
            }

        }

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.partner.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $partner = Partner::find($id);
        if ($partner->status == 1) {
            $partner->status = 0;
            $partner->save();
            $message = __('InActive Successfully');
        } else {
            $partner->status = 1;
            $partner->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
