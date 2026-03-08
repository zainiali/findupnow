<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryState;
use Illuminate\Http\Request;
use Str;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cities = City::with('providers')->get();

        return view('admin.city.city', compact('cities'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.city.create_city', compact('countries'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'country' => 'required',
            'state'   => 'required',
            'name'    => 'required|unique:cities',
        ];

        $customMessages = [
            'country.required' => __('Country is required'),
            'state.required'   => __('State is required'),
            'name.required'    => __('Service area is required'),
            'name.unique'      => __('Service area already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $city                   = new City();
        $city->country_state_id = $request->state;
        $city->name             = $request->name;
        $city->slug             = Str::slug($request->name);
        $city->status           = $request->status;
        $city->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $states    = CountryState::all();
        $city      = City::find($id);
        $countries = Country::all();
        return view('admin.city.edit_city', compact('states', 'city', 'countries'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $city  = City::find($id);
        $rules = [
            'country' => 'required',
            'state'   => 'required',
            'name'    => 'required|unique:cities,name,' . $city->id,
        ];
        $customMessages = [
            'country.required' => __('Country is required'),
            'state.required'   => __('State is required'),
            'name.required'    => __('Service area is required'),
            'name.unique'      => __('Service area already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $city->country_state_id = $request->state;
        $city->name             = $request->name;
        $city->slug             = Str::slug($request->name);
        $city->status           = $request->status;
        $city->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.city.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.city.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $city = City::find($id);
        if ($city->status == 1) {
            $city->status = 0;
            $city->save();
            $message = __('Inactive Successfully');
        } else {
            $city->status = 1;
            $city->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
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
}
