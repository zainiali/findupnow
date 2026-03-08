<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class MobileSliderController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sliders   = MobileSlider::orderBy('serial', 'asc')->get();
        $languages = Language::all();

        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        return view('admin.website-content.mobile_slider', compact('sliders', 'languages', 'code'));
    }

    public function create()
    {
        return view('admin.website-content.create_mobile_slider');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'title_one' => 'required',
            'title_two' => 'required',
            'serial'    => 'required',
            'image'     => 'required',
        ];
        $customMessages = [
            'title_one.required' => __('Title is required'),
            'title_two.required' => __('Title is required'),
            'serial.required'    => __('Serial is required'),
            'image.required'     => __('Image is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $slider = new MobileSlider();

        if ($request->hasFile('image')) {
            $slider->image = saveFileGetPath($request->image);
        }

        $slider->serial = $request->serial;
        $slider->status = 1;
        $slider->save();

        $request = Validator::make($request->all(), [
            'title_one' => 'required',
            'title_two' => 'required',
        ], [
            'title_one.required' => __('Title is required'),
            'title_two.required' => __('Title is required'),
        ]);

        $this->generateTranslations(TranslationModels::MOBILE_SLIDER_TRANSLATION, $slider, 'mobile_slider_id', $request);

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $slider = MobileSlider::find($id);

        $languages = Language::all();

        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        return view('admin.website-content.edit_mobile_slider', compact('slider', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title_one' => 'required',
            'title_two' => 'required',
            'serial'    => 'required',
        ];
        $customMessages = [
            'title_one.required' => __('Title is required'),
            'title_two.required' => __('Title is required'),
            'serial.required'    => __('Serial is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $slider = MobileSlider::find($id);

        if ($request->hasFile('image')) {
            $slider->image = saveFileGetPath($request->image, oldFile: $slider->image);
        }

        $slider->serial = $request->serial;
        $slider->status = 1;
        $slider->save();

        $this->updateTranslations($slider, $request, $request->only('title_one', 'title_two'));

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $slider          = MobileSlider::find($id);
        $existing_slider = $slider->image;
        $slider->translations()->each(function ($translation) {
            $translation->mobileSlider()->dissociate();
            $translation->delete();
        });
        $slider->delete();
        if ($existing_slider) {
            if (File::exists(public_path() . '/' . $existing_slider)) {
                unlink(public_path() . '/' . $existing_slider);
            }
        }

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }
}
