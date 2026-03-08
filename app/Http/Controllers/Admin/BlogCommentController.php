<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;

class BlogCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogComments = BlogComment::orderBy('id', 'desc')->get();
        return view('admin.blog.blog_comment', compact('blogComments'));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $blogComment = BlogComment::find($id);
        $blogComment->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.blog-comment.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $blogComment = BlogComment::find($id);
        if ($blogComment->status == 1) {
            $blogComment->status = 0;
            $blogComment->save();
            $message = __('Inactive Successfully');
        } else {
            $blogComment->status = 1;
            $blogComment->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }
}
