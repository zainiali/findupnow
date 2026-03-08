<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\ServiceArea;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProviderProfileCompletionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show profile completion form
     */
    public function showCompleteProfile()
    {
        $user = Auth::guard('web')->user();

        // Check if payment is completed
        if ($user->payment_status !== 'paid') {
            return redirect()->route('provider.subscription-plan')->with([
                'message' => __('Please complete payment first'),
                'alert-type' => 'error'
            ]);
        }

        // If profile already completed, redirect to dashboard
        if ($user->profile_completed) {
            return redirect()->route('provider.dashboard');
        }

        $countries = Country::orderBy('name', 'asc')->where('status', 1)->get();
        $states = CountryState::orderBy('name', 'asc')->where([
            'status' => 1, 
            'country_id' => $user->country_id
        ])->get();
        $cities = City::orderBy('name', 'asc')->where([
            'status' => 1, 
            'country_state_id' => $user->state_id
        ])->get();

        return view('website.provider.complete_profile', compact('user', 'countries', 'states', 'cities'));
    }

    /**
     * Store profile completion data
     */
    public function storeProfileCompletion(Request $request)
    {
        $user = Auth::guard('web')->user();

        // Validate payment status
        if ($user->payment_status !== 'paid') {
            $notification = __('Please complete payment first');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('provider.subscription-plan')->with($notification);
        }

        // Validation rules
        $rules = [
            'phone' => 'required',
            'designation' => 'required',
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $customMessages = [
            'phone.required' => __('Phone is required'),
            'designation.required' => __('Designation is required'),
            'country.required' => __('Country is required'),
            'state.required' => __('State is required'),
            'address.required' => __('Address is required'),
            'description.required' => __('Professional description is required'),
            'image.required' => __('Profile image is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        // Update user profile
        $user->phone = $request->phone;
        $user->designation = $request->designation;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->years_of_experience = $request->years_of_experience;

        // Handle image upload
        if ($request->hasFile('image')) {
            $user->image = saveFileGetPath($request->image, oldFile: $user->image);
        }

        // Mark profile as completed
        $user->profile_completed = true;
        $user->account_status = 'active';
        $user->save();

        // Handle service areas if provided
        if ($request->service_areas && is_array($request->service_areas)) {
            // Remove existing service areas
            ServiceArea::where('provider_id', $user->id)->delete();

            // Add new service areas
            foreach ($request->service_areas as $city_id) {
                $serviceArea = new ServiceArea();
                $serviceArea->provider_id = $user->id;
                $serviceArea->city_id = $city_id;
                $serviceArea->save();
            }
        }

        $notification = __('Profile completed successfully! Your account is now active.');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('provider.dashboard')->with($notification);
    }

    /**
     * Get states by country for AJAX
     */
    public function stateByCountry($id)
    {
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response = '<option value="">' . __('Select State') . '</option>';
        
        if ($states->count() > 0) {
            foreach ($states as $state) {
                $response .= "<option value='" . $state->id . "'>" . $state->name . "</option>";
            }
        }

        return response()->json(['states' => $response]);
    }

    /**
     * Get cities by state for AJAX
     */
    public function cityByState($id)
    {
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response = '<option value="">' . __('Select City') . '</option>';
        
        if ($cities->count() > 0) {
            foreach ($cities as $city) {
                $response .= "<option value='" . $city->id . "'>" . $city->name . "</option>";
            }
        }

        return response()->json(['cities' => $response]);
    }
}