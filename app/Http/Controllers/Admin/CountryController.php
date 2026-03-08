<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Str;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $countries = Country::with('countryStates')->get();
        return view('admin.country.country', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create_country');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name'   => 'required|unique:countries',
            'status' => 'required',
        ];
        $customMessages = [
            'name.required' => __('Name is required'),
            'name.unique'   => __('Name already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $country         = new Country();
        $country->name   = $request->name;
        $country->slug   = Str::slug($request->name);
        $country->status = $request->status;
        $country->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.country.edit_country', compact('country'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $rules   = [
            'name'   => 'required|unique:countries,name,' . $country->id,
            'status' => 'required',
        ];
        $customMessages = [
            'name.required' => __('Name is required'),
            'name.unique'   => __('Name already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $country->name   = $request->name;
        $country->slug   = Str::slug($request->name);
        $country->status = $request->status;
        $country->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.country.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.country.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $country = Country::find($id);
        if ($country->status == 1) {
            $country->status = 0;
            $country->save();
            $message = __('Inactive Successfully');
        } else {
            $country->status = 1;
            $country->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
