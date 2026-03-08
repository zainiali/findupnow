<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\SubscriptionPlan;

class SubscriptionController extends Controller
{

    public function index()
    {
        $plans = SubscriptionPlan::orderBy('serial', 'asc')->get();

        return view('subscription::admin.subscription', compact('plans'));
    }

    public function create()
    {
        return view('subscription::admin.subscription_create');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_name'       => 'required',
            'plan_price'      => 'required',
            'expiration_date' => 'required',
            'maximum_service' => $request->unlimited_service != '1' ? 'required|integer|min:1' : 'nullable',
            'serial'          => 'required',
            'status'          => 'required',
        ], [
            'plan_name.required'       => __('Plan name is required'),
            'plan_price.required'      => __('Plan price is required'),
            'expiration_date.required' => __('Expiration date is required'),
            'maximum_service.required' => __('Maximum service is required'),
            'maximum_service.min'      => __('Maximum service must be at least 1'),
            'serial.required'          => __('Serial is required'),

        ]);

        $plan                  = new SubscriptionPlan();
        $plan->plan_name       = $request->plan_name;
        $plan->plan_price      = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        // Handle unlimited service option
        $plan->maximum_service = $request->unlimited_service == '1' ? -1 : $request->maximum_service;
        $plan->serial          = $request->serial;
        $plan->status          = $request->status;
        $plan->save();

        $notification = __('Create Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * @param $id
     */
    public function edit($id)
    {

        $plan = SubscriptionPlan::find($id);

        return view('subscription::admin.subscription_edit', compact('plan'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_name'       => 'required',
            'plan_price'      => 'required',
            'expiration_date' => 'required',
            'maximum_service' => $request->unlimited_service != '1' ? 'required|integer|min:1' : 'nullable',
            'serial'          => 'required',
            'status'          => 'required',
        ], [
            'plan_name.required'       => __('Plan name is required'),
            'plan_price.required'      => __('Plan price is required'),
            'expiration_date.required' => __('Expiration date is required'),
            'maximum_service.required' => __('Maximum service is required'),
            'maximum_service.min'      => __('Maximum service must be at least 1'),
            'serial.required'          => __('Serial is required'),

        ]);

        $plan                  = SubscriptionPlan::find($id);
        $plan->plan_name       = $request->plan_name;
        $plan->plan_price      = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        // Handle unlimited service option
        $plan->maximum_service = $request->unlimited_service == '1' ? -1 : $request->maximum_service;
        $plan->serial          = $request->serial;
        $plan->status          = $request->status;
        $plan->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $plan = SubscriptionPlan::find($id);
        $plan->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.subscription-plan.index')->with($notification);

    }
}
