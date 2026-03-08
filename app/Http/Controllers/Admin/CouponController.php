<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Setting;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon_history()
    {

        $coupon_histories = CouponHistory::where(['provider_id' => 0])->orderBy('id', 'desc')->get();
        $setting          = Setting::first();

        return view('admin.coupon.coupon_history', compact('coupon_histories', 'setting'));
    }

    public function index()
    {

        $coupons = Coupon::where(['provider_id' => 0])->orderBy('id', 'desc')->get();

        return view('admin.coupon.coupon', compact('coupons'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'coupon_code'      => 'required|unique:coupons',
            'offer_percentage' => 'required|numeric',
            'expired_date'     => 'required',
        ];
        $customMessages = [
            'coupon_code.required'      => __('Coupon code is required'),
            'coupon_code.unique'        => __('Coupon already exist'),
            'offer_percentage.required' => __('Offer percentage is required'),
            'expired_date.required'     => __('Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon                   = new Coupon();
        $coupon->provider_id      = 0;
        $coupon->coupon_code      = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date     = $request->expired_date;
        $coupon->status           = $request->status;
        $coupon->save();

        $notification = __('Created Successfully');
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
            'coupon_code'      => 'required|unique:coupons,coupon_code,' . $id,
            'offer_percentage' => 'required|numeric',
            'expired_date'     => 'required',
        ];
        $customMessages = [
            'coupon_code.required'      => __('Coupon code is required'),
            'coupon_code.unique'        => __('Coupon already exist'),
            'offer_percentage.required' => __('Offer percentage is required'),
            'expired_date.required'     => __('Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon                   = Coupon::find($id);
        $coupon->coupon_code      = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date     = $request->expired_date;
        $coupon->status           = $request->status;
        $coupon->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
}
