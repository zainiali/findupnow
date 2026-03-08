<?php

namespace Modules\JobPost\Http\Controllers;

use App\Models\BreadcrumbImage;
use App\Models\City;
use App\Models\Setting;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobRequest;

class FontendHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function jobList()
    {
        $cities    = City::get();
        $job_posts = JobPost::where([
            'status'            => 'enable',
            'approved_by_admin' => 'approved',
        ])->latest()->get();
        $job_categories = \App\Models\Category::where('status', 1)->get();
        $setting        = Cache::get('setting');
        $currency_icon  = [
            'icon' => $setting->currency_icon,
        ];
        $currency_icon = (object) $currency_icon;

        $breadcrumb = BreadcrumbImage::where(['id' => 2])->first();

        return view('jobpost::job_list', compact('job_posts', 'job_categories', 'cities', 'currency_icon', 'breadcrumb'));
    }

    /**
     * @param Request $request
     */
    public function SerchJob(Request $request)
    {
        // Extract search parameters from the request
        $key      = $request->input('key');
        $location = $request->input('location');
        $category = $request->input('category');

        // Start building the query
        $query = JobPost::with('user', 'category');

        // Add conditions based on the search parameters
        if ($key) {
            $query->where('slug', 'like', '%' . $key . '%');
        }
        if ($location) {
            $query->where('city_id', $location);
        }
        if ($category) {
            $query->where('category_id', $category);
        }

        // Retrieve the job posts based on the search query
        $job_posts = $query->where([
            'status'            => 'enable',
            'approved_by_admin' => 'approved',
        ])->latest()->get();

        // Retrieve the cities
        $cities = City::get();

        // Retrieve the unique job categories
        $job_categories = \App\Models\Category::where('status', 1)->get();

        $breadcrumb = BreadcrumbImage::where(['id' => 2])->first();

        $setting       = Setting::first();
        $currency_icon = [
            'icon' => $setting->currency_icon,
        ];
        $currency_icon = (object) $currency_icon;

        // Return the view with the search results, cities, and job categories
        return view('jobpost::job_list', compact('job_posts', 'job_categories', 'cities', 'breadcrumb', 'currency_icon'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function JobDetils($slug)
    {
        $job_post = JobPost::where([
            'slug'              => $slug,
            'status'            => 'enable',
            'approved_by_admin' => 'approved',
        ])->latest()->firstOrFail();

        return view('jobpost::job_detils', compact('job_post'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request      $request
     * @return Renderable
     */
    public function ApplyJob(Request $request)
    {
        $rules = [
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ];

        $customMessages = [
            'resume.required' => __('Resume is required'),
        ];

        $request->validate($rules, $customMessages);

        $auth_user = Auth::guard('web')->user();

        if ($request->user_id == $auth_user->id) {
            $notification = __('You can not applied to your own job post');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $is_exist = JobRequest::where(['user_id' => $auth_user->id, 'job_post_id' => $request->job_id])->count();
        if ($is_exist > 0) {
            $notification = __('Application already submited');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $approval_check = JobRequest::where('job_post_id', $request->job_id)->where('status', 'approved')->count();

        if ($approval_check > 0) {
            $notification = __('Job already has assigned, so you can not apply');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        // Validate the uploaded file
        if ($request->hasFile('resume')) {
            $pdfFile  = $request->file('resume');
            $fileName = uniqid('pdf_') . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path('uploads/resume'), $fileName);
            // Save the file path in the database
            $resumePath = 'uploads/resume/' . $fileName;
        }

        $job_request              = new JobRequest();
        $job_request->user_id     = $auth_user->id;
        $job_request->seller_id   = $request->user_id;
        $job_request->job_post_id = $request->job_id;
        $job_request->description = $request->message;
        $job_request->resume      = $resumePath;
        $job_request->save();

        $notification = __('Your application has submited successfully, please wait for approval');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }
}
