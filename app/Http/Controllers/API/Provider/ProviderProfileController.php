<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Order;
use App\Models\ProviderWithdraw;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProviderProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'checkprovider.api']);
    }

    public function index()
    {
        $user = User::select('id', 'name', 'email', 'image', 'phone', 'designation', 'status', 'is_provider', 'country_id', 'state_id', 'city_id', 'address', 'created_at')->where('id', Auth::guard('api')->user()->id)->first();

        $countries = Country::orderBy('name', 'asc')->select('id', 'name')->where('status', 1)->get();
        $states    = CountryState::orderBy('name', 'asc')->select('id', 'name', 'country_id')->where(['status' => 1, 'country_id' => $user->country_id])->get();
        $cities    = City::orderBy('name', 'asc')->select('id', 'name', 'country_state_id')->where(['status' => 1, 'country_state_id' => $user->state_id])->get();

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => $setting->currency_icon,
        ];
        $currency_icon = (object) $currency_icon;

        $default_avatar = [
            'image' => $setting->default_avatar,
        ];

        $default_avatar = (object) $default_avatar;

        $provider           = $user;
        $orders             = Order::where('provider_id', $provider->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = ProviderWithdraw::where('user_id', $provider->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services      = Service::where('provider_id', $provider->id)->get();
        $total_service = $services->count();

        return response()->json([
            'user'               => $user,
            'countries'          => $countries,
            'states'             => $states,
            'cities'             => $cities,
            'currency_icon'      => $currency_icon,
            'default_avatar'     => $default_avatar,
            'total_sold_service' => $total_sold_service,
            'total_balance'      => $total_balance,
            'total_withdraw'     => $total_withdraw,
            'total_service'      => $total_service,
            'current_balance'    => $current_balance,
        ]);
    }

    /**
     * @param $id
     */
    public function stateByCountry($id)
    {
        $states   = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response = '<option value="">' . __('Select') . '</option>';
        if ($states->count() > 0) {
            foreach ($states as $state) {
                $response .= "<option value=" . $state->id . ">" . $state->name . "</option>";
            }
        }

        return response()->json(['states' => $response]);
    }

    /**
     * @param $id
     */
    public function cityByState($id)
    {
        $cities   = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response = '<option value="">' . __('Select') . '</option>';
        if ($cities->count() > 0) {
            foreach ($cities as $city) {
                $response .= "<option value=" . $city->id . ">" . $city->name . "</option>";
            }
        }

        return response()->json(['cities' => $response]);
    }

    /**
     * @param Request $request
     */
    public function updateSellerProfile(Request $request)
    {
        $user = Auth::guard('api')->user();

        $rules = [
            'name'        => 'required',
            'email'       => 'required|unique:users,email,' . $user->id,
            'phone'       => 'required',
            'country'     => 'required',
            'state'       => 'required',
            'city'        => 'required',
            'designation' => 'required',
            'address'     => 'required',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'email.required'       => __('Email is required'),
            'email.unique'         => __('Email already exist'),
            'phone.required'       => __('Phone is required'),
            'country.required'     => __('Country or region is required'),
            'state.required'       => __('State or province is required'),
            'city.required'        => __('Service area is required'),
            'designation.required' => __('Desgination is required'),
            'address.required'     => __('Address is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user->name        = $request->name;
        $user->phone       = $request->phone;
        $user->country_id  = $request->country;
        $user->state_id    = $request->state;
        $user->city_id     = $request->city;
        $user->address     = $request->address;
        $user->designation = $request->designation;
        $user->save();

        if ($request->file('image')) {
            $user->image = saveFileGetPath($request->image, oldFile: $user->image);
            $user->save();
        }

        $notification = __('Update Successfully');
        return response()->json(['message' => $notification]);
    }

    /**
     * @param Request $request
     */
    public function updatePassword(Request $request)
    {
        $user  = Auth::guard('api')->user();
        $rules = [
            'password' => 'required|min:4|confirmed',
        ];

        $customMessages = [
            'password.required'  => __('Password is required'),
            'password.min'       => __('Password must be 4 characters'),
            'password.confirmed' => __('Confirm password does not match'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user->password = Hash::make($request->password);

        $user->save();

        $notification = __('Password Change Successfully');
        return response()->json(['message' => $notification]);
    }

    public function schedule()
    {
        $user      = Auth::guard('api')->user();
        $schedules = Schedule::where('provider_id', $user->id)->get();
        $days      = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];

        return response()->json(['schedules' => $schedules, 'days' => $days]);
    }

    /**
     * @param Request $request
     */
    public function updateSchedule(Request $request)
    {
        $request->validate([
            'ids' => 'required',
        ]);

        $user        = Auth::guard('api')->user();
        $is_scheudle = Schedule::where('provider_id', $user->id)->count();
        if ($is_scheudle) {
            foreach ($request->ids as $index => $id) {
                $schedule         = Schedule::find($id);
                $schedule->start  = $request->start[$index];
                $schedule->end    = $request->end[$index];
                $schedule->status = $request->status[$index];
                $schedule->save();
            }
        } else {
            foreach ($request->days as $index => $day) {
                $schedule                = new Schedule();
                $schedule->provider_id   = $user->id;
                $schedule->day           = $day;
                $schedule->start         = $request->start[$index];
                $schedule->end           = $request->end[$index];
                $schedule->status        = $request->status[$index];
                $schedule->serial_of_day = $index;
                $schedule->save();
            }
        }
        $notification = __('Update Successfully');
        return response()->json(['message' => $notification]);
    }

}
