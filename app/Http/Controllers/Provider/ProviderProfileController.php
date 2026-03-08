<?php

namespace App\Http\Controllers\Provider;

use App\Exports\CityExport;
use App\Exports\ServiceAreaExport;
use App\Http\Controllers\Controller;
use App\Imports\ServiceAreaImport;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Order;
use App\Models\ProviderWithdraw;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\Setting;
use App\Models\User;
use Auth;
use File;
use Hash;
use Illuminate\Http\Request;
use Image;
use Maatwebsite\Excel\Facades\Excel;

// use App\Imports\CityImport;

class ProviderProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {

        $user = Auth::guard('web')->user();
        $user = User::select('id', 'name', 'email', 'image', 'phone', 'designation', 'status', 'is_provider', 'country_id', 'state_id', 'city_id', 'address', 'created_at')->where('id', $user->id)->first();

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

        $service_areas = ServiceArea::with('city')->where('provider_id', $provider->id)->get();

        return view('website.provider.provider_profile')->with([
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
            'service_areas'      => $service_areas,
        ]);
    }

    public function changePassword()
    {
        return view('website.provider.change_password');
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
        $user  = Auth::guard('web')->user();
        $rules = [
            'name'        => 'required',
            'email'       => 'required|unique:users,email,' . $user->id,
            'phone'       => 'required',
            'country'     => 'required',
            'state'       => 'required',
            'designation' => 'required',
            'address'     => 'required',
            'image'       => 'nullable|mimetypes:image/jpeg,image/pjpeg,image/png,image/gif,image/svg+xml,image/webp,image/avif,image/bmp,image/x-icon,image/vnd.microsoft.icon|max:2048',
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
        $user->address     = $request->address;
        $user->designation = $request->designation;
        $user->save();

        if ($request->hasFile('image')) {
            $user->image = saveFileGetPath($request->image, oldFile: $user->image);
            $user->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function updatePassword(Request $request)
    {
        $user  = Auth::guard('web')->user();
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
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $state_id
     */
    public function export_service_area($state_id)
    {
        $cities = City::where('country_state_id', $state_id)->select('id', 'name')->get();

        return Excel::download(new CityExport($cities), 'cities.xlsx');
    }

    public function export_selected_area()
    {
        $user          = Auth::guard('web')->user();
        $service_areas = ServiceArea::where('provider_id', $user->id)->select('city_id')->get();

        return Excel::download(new ServiceAreaExport($service_areas), 'service_areas.xlsx');
    }

    /**
     * @param Request $request
     */
    public function store_import_service_area(Request $request)
    {
        Excel::import(new ServiceAreaImport, $request->file('file'));

        $notification = __('Uploaded Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function store_single_area(Request $request)
    {
        $rules = [
            'delivery_area_id' => 'required',
        ];

        $customMessages = [
            'delivery_area_id.required' => __('Area id is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = Auth::guard('web')->user();

        $count = ServiceArea::where(['provider_id' => $user->id, 'city_id' => $request->delivery_area_id])->count();

        if ($count == 0) {
            $area              = new ServiceArea();
            $area->provider_id = $user->id;
            $area->city_id     = $request->delivery_area_id;
            $area->save();

            $notification = __('Created Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

        } else {
            $notification = __('Area already exist');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    /**
     * @param $id
     */
    public function remove_single_area($id)
    {
        $area = ServiceArea::find($id);
        $area->delete();

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
