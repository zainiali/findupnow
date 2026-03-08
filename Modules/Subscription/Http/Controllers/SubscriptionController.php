<?php

namespace Modules\Subscription\Http\Controllers;

use App\Models\BreadcrumbImage;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\SubscriptionPlan;

class SubscriptionController extends Controller
{

    public function subscription_plan()
    {

        $breadcrumb = BreadcrumbImage::where(['id' => 12])->first();

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial', 'asc')->get();

        $active_theme = getActiveThemeLayout();

        return view('subscription::subscription_plan', compact('active_theme', 'plans', 'breadcrumb'));
    }
}
