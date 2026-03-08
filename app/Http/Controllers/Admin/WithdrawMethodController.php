<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $methods = WithdrawMethod::all();
        $setting = Setting::first();
        return view('admin.withdraw-method.withdraw_method', compact('methods', 'setting'));
    }

    public function create()
    {
        $setting = Setting::first();
        return view('admin.withdraw-method.create_withdraw_method', compact('setting'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name'            => 'required',
            'minimum_amount'  => 'required',
            'maximum_amount'  => 'required',
            'withdraw_charge' => 'required',
            'description'     => 'required',
        ];
        $customMessages = [
            'name.required'            => __('Title is required'),
            'minimum_amount.required'  => __('Public key is required'),
            'maximum_amount.required'  => __('Secret key is required'),
            'withdraw_charge.required' => __('Currency rate is required'),
            'description.required'     => __('Currency name is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $method                  = new WithdrawMethod();
        $method->name            = $request->name;
        $method->min_amount      = $request->minimum_amount;
        $method->max_amount      = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description     = $request->description;
        $method->status          = 1;
        $method->save();

        $notification = __('Create Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $method  = WithdrawMethod::find($id);
        $setting = Setting::first();
        return view('admin.withdraw-method.edit_withdraw_method', compact('method', 'setting'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'name'            => 'required',
            'minimum_amount'  => 'required',
            'maximum_amount'  => 'required',
            'withdraw_charge' => 'required',
            'description'     => 'required',
        ];
        $customMessages = [
            'name.required'            => __('Title is required'),
            'minimum_amount.required'  => __('Public key is required'),
            'maximum_amount.required'  => __('Secret key is required'),
            'withdraw_charge.required' => __('Currency rate is required'),
            'description.required'     => __('Currency name is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $method                  = WithdrawMethod::find($id);
        $method->name            = $request->name;
        $method->min_amount      = $request->minimum_amount;
        $method->max_amount      = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description     = $request->description;
        $method->status          = 1;
        $method->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $method = WithdrawMethod::find($id);
        $method->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $method = WithdrawMethod::find($id);
        if ($method->status == 1) {
            $method->status = 0;
            $method->save();
            $message = __('Inactive Successfully');
        } else {
            $method->status = 1;
            $method->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
