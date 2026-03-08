<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\PopularPost;
use Auth;
use File;
use Illuminate\Http\Request;
use Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('admin.blog.blog', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.blog.create_blog', compact('categories'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'title'         => 'required|unique:blogs',
            'slug'          => 'required|unique:blogs',
            'image'         => 'required',
            'description'   => 'required',
            'category'      => 'required',
            'status'        => 'required',
            'show_homepage' => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'title.unique'         => __('Title already exist'),
            'slug.required'        => __('Slug is required'),
            'slug.unique'          => __('Slug already exist'),
            'image.required'       => __('Image is required'),
            'description.required' => __('Description is required'),
            'category.required'    => __('Category is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $admin = Auth::guard('admin')->user();
        $blog  = new Blog();
        if ($request->hasFile('image')) {
            $blog->image = saveFileGetPath($request->image);
        }

        $blog->admin_id         = $admin->id;
        $blog->title            = $request->title;
        $blog->slug             = $request->slug;
        $blog->description      = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->status           = $request->status;
        $blog->show_homepage    = $request->show_homepage;
        $blog->seo_title        = $request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description  = $request->seo_description ? $request->seo_description : $request->title;
        $blog->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $categories = BlogCategory::where('status', 1)->get();
        $blog       = Blog::find($id);
        return view('admin.blog.edit_blog', compact('categories', 'blog'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $blog  = Blog::find($id);
        $rules = [
            'title'         => 'required|unique:blogs,title,' . $blog->id,
            'slug'          => 'required|unique:blogs,slug,' . $blog->id,
            'description'   => 'required',
            'category'      => 'required',
            'status'        => 'required',
            'show_homepage' => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'title.unique'         => __('Title already exist'),
            'slug.required'        => __('Slug is required'),
            'slug.unique'          => __('Slug already exist'),
            'description.required' => __('Description is required'),
            'category.required'    => __('Category is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->image) {
            $old_image   = $blog->image;
            $blog->image = saveFileGetPath($request->image, oldFile: $old_image);
            $blog->save();
        }

        if ($request->banner_image) {
            $exist_banner       = $blog->banner_image;
            $blog->banner_image = saveFileGetPath($request->banner_image, oldFile: $exist_banner);
            $blog->save();
        }

        $blog->title            = $request->title;
        $blog->slug             = $request->slug;
        $blog->description      = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->status           = $request->status;
        $blog->show_homepage    = $request->show_homepage;
        $blog->seo_title        = $request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description  = $request->seo_description ? $request->seo_description : $request->title;
        $blog->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $blog       = Blog::find($id);
        $old_image  = $blog->image;
        $old_banner = $blog->banner_image;
        $blog->delete();
        if ($old_image) {
            if (File::exists(public_path() . '/' . $old_image)) {
                unlink(public_path() . '/' . $old_image);
            }

        }
        if ($old_banner) {
            if (File::exists(public_path() . '/' . $old_banner)) {
                unlink(public_path() . '/' . $old_banner);
            }

        }
        BlogComment::where('blog_id', $id)->delete();
        PopularPost::where('blog_id', $id)->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $blog = Blog::find($id);
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
