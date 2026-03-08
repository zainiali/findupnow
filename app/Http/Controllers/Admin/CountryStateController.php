<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryState;
use Illuminate\Http\Request;
use Str;

class CountryStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $states = CountryState::with('cities')->get();

        return view('admin.state.state', compact('states'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.state.create_state', compact('countries'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'country' => 'required',
            'name'    => 'required|unique:country_states',
        ];
        $customMessages = [
            'country.required' => __('Country is required'),
            'name.required'    => __('Name is required'),
            'name.unique'      => __('Name already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $state             = new CountryState();
        $state->country_id = $request->country;
        $state->name       = $request->name;
        $state->slug       = Str::slug($request->name);
        $state->status     = $request->status;
        $state->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $state     = CountryState::find($id);
        $countries = Country::all();
        return view('admin.state.edit_state', compact('state', 'countries'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $state = CountryState::find($id);
        $rules = [
            'country' => 'required',
            'name'    => 'required|unique:country_states,name,' . $state->id,
            'status'  => 'required',
        ];
        $customMessages = [
            'country.required' => __('Country is required'),
            'name.required'    => __('Name is required'),
            'name.unique'      => __('Name already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $state->country_id = $request->country;
        $state->name       = $request->name;
        $state->slug       = Str::slug($request->name);
        $state->status     = $request->status;
        $state->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.state.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $state = CountryState::find($id);
        $state->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.state.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $state = CountryState::find($id);
        if ($state->status == 1) {
            $state->status = 0;
            $state->save();
            $message = __('Inactive Successfully');
        } else {
            $state->status = 1;
            $state->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
