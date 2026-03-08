<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\PopularPost;
use Illuminate\Http\Request;

class PopularBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs        = Blog::where('status', 1)->get();
        $popularBlogs = PopularPost::all();
        return view('admin.blog.popular_blog', compact('blogs', 'popularBlogs'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'blog_id' => 'required|unique:popular_posts',
        ];
        $customMessages = [
            'blog_id.required' => __('Blog is required'),
            'blog_id.unique'   => __('Blog already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $popularBlog          = new PopularPost();
        $popularBlog->blog_id = $request->blog_id;
        $popularBlog->status  = 1;
        $popularBlog->save();

        $notification = __('Added Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.popular-blog.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $blog = PopularPost::find($id);
        $blog->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.popular-blog.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $blog = PopularPost::find($id);
        if ($blog->status == 1) {
            $blog->status = 0;
            $blog->save();
            $message = __('Inactive Successfully');
        } else {
            $blog->status = 1;
            $blog->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
