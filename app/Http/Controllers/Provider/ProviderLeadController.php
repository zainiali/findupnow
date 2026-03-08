<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\ServiceLead;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProviderLeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Display all leads matched to this provider
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();

        // Get leads matched to this provider
        $leads = ServiceLead::with('category')
            ->forProvider($provider->id)
            ->orderBy('created_at', 'desc');

        // Filter by status if requested
        if ($request->has('status') && $request->status != 'all') {
            $leads = $leads->where('status', $request->status);
        }

        // Search by lead ID
        if ($request->has('lead_id') && $request->lead_id) {
            $leads = $leads->where('lead_id', 'like', '%' . $request->lead_id . '%');
        }

        $leads = $leads->paginate(15);

        $setting = Setting::first();
        $currency_icon = (object) ['icon' => $setting->currency_icon];

        // Count leads by status for stats
        $new_leads_count = ServiceLead::forProvider($provider->id)->where('status', 'new')->count();
        $contacted_leads_count = ServiceLead::forProvider($provider->id)->where('status', 'contacted')->count();
        $converted_leads_count = ServiceLead::forProvider($provider->id)->where('status', 'converted')->count();

        $title = __('Service Leads');

        return view('website.provider.leads', compact(
            'leads', 
            'title', 
            'currency_icon',
            'new_leads_count',
            'contacted_leads_count',
            'converted_leads_count'
        ));
    }

    /**
     * Show detailed view of a specific lead
     */
    public function show($leadId)
    {
        $provider = Auth::guard('web')->user();
        
        $lead = ServiceLead::with('category')
            ->where('lead_id', $leadId)
            ->firstOrFail();

        // Security check: Verify provider has access to this lead
        if (!$lead->isMatchedToProvider($provider->id)) {
            $notification = __('You do not have access to this lead');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('provider.leads')->with($notification);
        }

        // Track that provider viewed this lead
        $lead->markAsViewedBy($provider->id);

        $setting = Setting::first();
        $currency_icon = (object) ['icon' => $setting->currency_icon];

        return view('website.provider.show_lead', compact('lead', 'currency_icon'));
    }

    /**
     * Update lead status manually
     */
    public function updateStatus(Request $request, $id)
    {
        $provider = Auth::guard('web')->user();
        
        $lead = ServiceLead::findOrFail($id);

        // Security check: Verify provider has access
        if (!$lead->isMatchedToProvider($provider->id)) {
            $notification = __('You do not have access to this lead');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $rules = [
            'status' => 'required|in:new,contacted,converted,closed'
        ];

        $this->validate($request, $rules);

        $lead->status = $request->status;
        $lead->save();

        $notification = __('Lead status updated successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Get count of new leads (for badge/notification)
     */
    public function getNewLeadsCount()
    {
        $provider = Auth::guard('web')->user();
        
        // Get new leads from last 7 days
        $count = ServiceLead::forProvider($provider->id)
            ->where('status', 'new')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Mark lead as contacted
     */
    public function markAsContacted($id)
    {
        $provider = Auth::guard('web')->user();
        
        $lead = ServiceLead::findOrFail($id);

        // Security check
        if (!$lead->isMatchedToProvider($provider->id)) {
            $notification = __('You do not have access to this lead');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $lead->status = 'contacted';
        $lead->save();

        $notification = __('Lead marked as contacted');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Mark lead as converted (successful booking)
     */
    public function markAsConverted($id)
    {
        $provider = Auth::guard('web')->user();
        
        $lead = ServiceLead::findOrFail($id);

        // Security check
        if (!$lead->isMatchedToProvider($provider->id)) {
            $notification = __('You do not have access to this lead');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $lead->status = 'converted';
        $lead->save();

        $notification = __('Lead marked as converted');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}