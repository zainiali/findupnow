<?php

namespace Modules\JobPost\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobPostTranslation;
use Modules\JobPost\Entities\JobRequest;
use Modules\JobPost\Http\Requests\JobPostRequest;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $job_posts = JobPost::latest()->paginate(20);

        return view('jobpost::admin.index', compact('job_posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $categories = Category::where('status', 1)->get();

        $cities = City::where('status', 1)->get();

        $agents = User::where(['status' => 1, 'is_provider' => 0])->where('email_verified_at', null)->orderBy('id', 'desc')->get();

        return view('jobpost::admin.create', compact('categories', 'cities', 'agents'));

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request      $request
     * @return Renderable
     */
    public function store(JobPostRequest $request)
    {
        $job_post = new JobPost();

        if ($request->hasFile('thumb_image')) {
            $job_post->thumb_image = saveFileGetPath($request->thumb_image);
        }

        $job_post->user_id           = $request->user_id;
        $job_post->category_id       = $request->category_id;
        $job_post->city_id           = $request->city_id;
        $job_post->slug              = $request->slug;
        $job_post->regular_price     = $request->regular_price;
        $job_post->job_type          = $request->job_type;
        $job_post->title             = $request->title;
        $job_post->description       = $request->description;
        $job_post->address           = $request->address;
        $job_post->approved_by_admin = $request->approved_by_admin == 'approved' ? 'approved' : 'pending';
        $job_post->status            = $request->status == 'enable' ? 'enable' : 'disable';
        $job_post->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.jobpost.edit', $job_post->id)->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int          $id
     * @return Renderable
     */
    public function edit($id)
    {
        $job_post = JobPost::findOrFail($id);

        $categories = Category::where('status', 1)->get();

        $cities = City::where('status', 1)->get();

        $agents = User::where(['status' => 1, 'is_provider' => 0])->where('email_verified_at', null)->orderBy('id', 'desc')->get();

        return view('jobpost::admin.edit', compact('categories', 'cities', 'agents', 'job_post'));

    }

    /**
     * Update the specified resource in storage.
     * @param  Request      $request
     * @param  int          $id
     * @return Renderable
     */
    public function update(JobPostRequest $request, $id)
    {
        $job_post = JobPost::findOrFail($id);

        if ($request->hasFile('thumb_image')) {
            $job_post->thumb_image = saveFileGetPath($request->thumb_image, oldFile: $job_post->thumb_image);
        }

        $job_post->title             = $request->title;
        $job_post->description       = $request->description;
        $job_post->address           = $request->address;
        $job_post->user_id           = $request->user_id;
        $job_post->category_id       = $request->category_id;
        $job_post->city_id           = $request->city_id;
        $job_post->slug              = $request->slug;
        $job_post->regular_price     = $request->regular_price;
        $job_post->job_type          = $request->job_type;
        $job_post->status            = $request->status == 'enable' ? 'enable' : 'disable';
        $job_post->approved_by_admin = $request->approved_by_admin == 'approved' ? 'approved' : 'pending';
        $job_post->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int          $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jobpost = JobPost::findOrFail($id);

        try {
            if ($jobpost->thumb_image) {
                @unlink(public_path($jobpost->thumb_image));
            }
        } catch (Exception $e) {
            logger($e);
        }

        $jobpost->delete();

        JobRequest::where('job_post_id', $id)->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.jobpost.index')->with($notification);
    }

    /**
     * @param $lang_code
     */
    public function assign_language($lang_code)
    {
        $jobpost_translates = JobPostTranslation::where('lang_code', admin_lang())->get();
        foreach ($jobpost_translates as $jobpost_translate) {
            $translate              = new JobPostTranslation();
            $translate->job_post_id = $jobpost_translate->job_post_id;
            $translate->lang_code   = $lang_code;
            $translate->title       = $jobpost_translate->title;
            $translate->description = $jobpost_translate->description;
            $translate->address     = $jobpost_translate->address;
            $translate->save();
        }
    }

    /**
     * @param $id
     */
    public function jobpost_approval($id)
    {
        $job_post                    = JobPost::findOrFail($id);
        $job_post->approved_by_admin = 'approved';
        $job_post->status            = 'enable';
        $job_post->save();

        $notification = __('Apporval Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function job_post_applicants($id)
    {
        $job_requests = JobRequest::where('job_post_id', $id)->latest()->get();

        return view('jobpost::admin.job_applicants', ['job_requests' => $job_requests]);

    }

    /**
     * @param $id
     */
    public function job_application_approval($id)
    {

        $job_request = JobRequest::findOrFail($id);

        $approval_check = JobRequest::where('job_post_id', $job_request->job_post_id)->where('status', 'approved')->count();

        if ($approval_check == 0) {
            $job_request         = JobRequest::findOrFail($id);
            $job_request->status = 'approved';
            $job_request->save();

            JobRequest::where('job_post_id', $job_request->job_post_id)->where('id', '!=', $id)->update(['status' => 'rejected']);

            $notification = __('Job assigned successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);

        } else {
            $notification = __('Job already has assigned, so you can not assign again');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    /**
     * @param $id
     */
    public function job_application_delete($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_request->delete();

        $notification = __('Deleted successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

}
