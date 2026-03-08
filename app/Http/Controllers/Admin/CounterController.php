<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class CounterController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $counters         = Counter::all();
        $setting          = Setting::first()->counter_bg_image;
        $counter_bg_image = [
            'counter_bg_image' => $setting,
        ];
        $counter_bg_image = (object) $counter_bg_image;

        return view('admin.counter.counter', compact('counters', 'counter_bg_image'));
    }

    public function create()
    {
        return view('admin.counter.create_counter');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required',
            'icon'   => 'required',
            'number' => 'required',
            'status' => 'required',
        ];

        $customMessages = [
            'title.required'  => __('Title is required'),
            'title.unique'    => __('Title already exist'),
            'icon.required'   => __('Icon is required'),
            'number.required' => __('Number is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $counter         = new Counter();
        $counter->icon   = $request->icon;
        $counter->number = $request->number;
        $counter->status = $request->status;
        if ($request->hasFile('icon')) {
            $counter->icon = saveFileGetPath($request->icon);
        }
        $counter->save();

        $request = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        $this->generateTranslations(TranslationModels::COUNTER_TRANSLATION, $counter, 'counter_id', $request);

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.counter.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $counter   = Counter::findOrFail($id);
        $languages = Language::all();
        $code      = request()->filled('code') ? request('code') : getSessionLanguage();
        return view('admin.counter.edit_counter', compact('counter', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $counter = Counter::findOrFail($id);
        $rules   = [
            'title'  => 'required',
            'number' => 'required',
            'status' => 'required',
        ];
        $customMessages = [
            'title.required'  => __('Title is required'),
            'title.unique'    => __('Title already exist'),
            'number.required' => __('Number is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $counter->number = $request->number;
        $counter->status = $request->status;
        if ($request->hasFile('icon')) {
            $counter->icon = saveFileGetPath($request->icon, oldFile: $counter->icon);
        }
        $counter->save();

        $this->updateTranslations($counter, $request, $request->only('title'));

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.counter.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $counter   = Counter::find($id);
        $old_image = $counter->icon;
        $counter->translations()->each(function ($translation) {
            $translation->counter()->dissociate();
            $translation->delete();
        });
        $counter->delete();
        if ($old_image) {
            if (File::exists(public_path() . '/' . $old_image)) {
                unlink(public_path() . '/' . $old_image);
            }

        }

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.counter.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $counter         = Counter::find($id);
        $counter->status = $counter->status == 1 ? 0 : 1;
        $counter->save();

        return response()->json($counter->status == 1 ? __('Active Successfully') : __('Inactive Successfully'));
    }

    /**
     * @param Request $request
     */
    public function updateCounterBg(Request $request)
    {
        $setting = Setting::first();
        if ($request->has('image')) {
            $setting->counter_bg_image = saveFileGetPath($request->image, oldFile: $setting->counter_bg_image);
            $setting->save();
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.counter.index')->with($notification);
    }
}
