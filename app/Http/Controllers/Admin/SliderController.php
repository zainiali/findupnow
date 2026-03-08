<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class SliderController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $slider = Slider::first();

        $setting        = Setting::first();
        $selected_theme = $setting->selected_theme;
        $languages      = Language::all();

        $code = request()->filled('code') ? request('code') : getSessionLanguage();

        return view('admin.website-content.create_slider', compact('slider', 'selected_theme', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title'              => 'required',
            'description'        => 'required',
            'header_one'         => 'required',
            'header_two'         => 'required',
            'total_service_sold' => 'required',
        ];
        $customMessages = [
            'title.required'              => __('Title is required'),
            'description.required'        => __('Description is required'),
            'header_one.required'         => __('Header one is required'),
            'header_two.required'         => __('Header two is required'),
            'total_service_sold.required' => __('Total sold service is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $slider = Slider::find($id);
        if ($request->hasFile('image')) {
            $slider->image = saveFileGetPath($request->image, oldFile: $slider->image);
            $slider->save();
        }

        if ($request->hasFile('image2')) {
            $slider->home2_image = saveFileGetPath($request->image2, oldFile: $slider->home2_image);
            $slider->save();
        }

        if ($request->hasFile('image3')) {
            $slider->home3_image = saveFileGetPath($request->image3, oldFile: $slider->home3_image);
            $slider->save();
        }

        $slider->popular_tag = $request->popular_tag;
        $slider->save();

        $this->updateTranslations($slider, $request, $request->only('title', 'description', 'header_one', 'header_two', 'total_service_sold'));

        return redirect()->back()->with(['message' => __('Update Successfully'), 'alert-type' => 'success']);
    }

}
