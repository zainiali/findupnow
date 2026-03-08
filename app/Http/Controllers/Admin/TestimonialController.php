<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class TestimonialController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $testimonials = Testimonial::all();

        return view('admin.testimonial.testimonial', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create_testimonial');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required',
            'designation' => 'required',
            'image'       => 'required',
            'status'      => 'required',
            'comment'     => 'required',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'designation.required' => __('Designation is required'),
            'image.required'       => __('Image is required'),
            'comment.required'     => __('Comment is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $testimonial = new Testimonial();

        if ($request->hasFile('image')) {
            $testimonial->image = saveFileGetPath($request->image);
        }

        $testimonial->status = $request->status;
        $testimonial->save();

        $request = Validator::make($request->all(), [
            'name'        => 'required',
            'designation' => 'required',
            'comment'     => 'required',
        ]);

        $this->generateTranslations(TranslationModels::TESTIMONIAL_TRANSLATION, $testimonial, 'testimonial_id', $request);

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $languages   = Language::all();

        $code = request()->filled('code') ? request('code') : getSessionLanguage();
        return view('admin.testimonial.edit_testimonial', compact('testimonial', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
        $rules       = [
            'name'        => 'required',
            'designation' => 'required',
            'status'      => 'required',
            'comment'     => 'required',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'designation.required' => __('Designation is required'),
            'comment.required'     => __('Comment is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->hasFile('image')) {
            $testimonial->image = saveFileGetPath($request->image, oldFile: $testimonial->image);
        }

        $testimonial->status = $request->status;
        $testimonial->save();

        $this->updateTranslations($testimonial, $request, $request->only('name', 'designation', 'comment'));

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $testimonial    = Testimonial::find($id);
        $existing_image = $testimonial->image;
        $testimonial->translations()->delete();
        $testimonial->delete();

        if ($existing_image) {
            if (File::exists(public_path() . '/' . $existing_image)) {
                unlink(public_path() . '/' . $existing_image);
            }

        }

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $item         = Testimonial::find($id);
        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();

        return response()->json($item->status == 1 ? __('Active Successfully') : __('Inactive Successfully'));
    }
}
