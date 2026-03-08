<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = BlogCategory::with('blogs')->get();
        return view('admin.blog.blog_category', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.create_blog_category');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name'   => 'required|unique:blog_categories',
            'slug'   => 'required|unique:blog_categories',
            'status' => 'required',
        ];
        $customMessages = [
            'name.required' => __('Name is required'),
            'name.unique'   => __('Name already exist'),
            'slug.required' => __('Slug is required'),
            'slug.unique'   => __('Slug already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $category         = new BlogCategory();
        $category->name   = $request->name;
        $category->slug   = $request->slug;
        $category->status = $request->status;
        $category->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $category = BlogCategory::find($id);
        return view('admin.blog.edit_blog_category', compact('category'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $category = BlogCategory::find($id);
        $rules    = [
            'name'   => 'required|unique:blog_categories,name,' . $category->id,
            'slug'   => 'required|unique:blog_categories,slug,' . $category->id,
            'status' => 'required',
        ];
        $customMessages = [
            'name.required' => __('Name is required'),
            'name.unique'   => __('Name already exist'),
            'slug.required' => __('Slug is required'),
            'slug.unique'   => __('Slug already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $category         = BlogCategory::find($id);
        $category->name   = $request->name;
        $category->slug   = $request->slug;
        $category->status = $request->status;
        $category->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        $category->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $category = BlogCategory::find($id);
        if ($category->status == 1) {
            $category->status = 0;
            $category->save();
            $message = __('Inactive Successfully');
        } else {
            $category->status = 1;
            $category->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
