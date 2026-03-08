<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class CategoryController extends Controller
{
    use GenerateTranslationTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('service')->get();

        $setting = Setting::first();

        $selected_theme = $setting->selected_theme;

        return view('admin.category.category', compact('categories', 'selected_theme'));
    }

    public function create()
    {
        $setting = Setting::first();

        $selected_theme = $setting->selected_theme;

        return view('admin.category.create_product_category', compact('selected_theme'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $setting = Setting::first();

        $selected_theme = $setting->selected_theme;

        $rules = [
            'name'   => 'required|string|max:190',
            'slug'   => 'required|unique:categories',
            'status' => 'required',
            'icon'   => 'required',
            'image'  => $selected_theme == 0 || $selected_theme == 3 ? 'required' : '',
        ];

        $customMessages = [
            'name.required'  => __('Name is required'),
            'slug.required'  => __('Slug is required'),
            'slug.unique'    => __('Slug already exist'),
            'icon.required'  => __('Icon is required'),
            'image.required' => __('Image is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $category = new Category();
        if ($request->hasFile('icon')) {
            $category->icon = saveFileGetPath($request->icon);
        }

        if ($request->hasFile('image')) {
            $category->image = saveFileGetPath($request->image);
        }

        $category->slug   = $request->slug;
        $category->status = $request->status;
        $category->save();

        $rules = [
            'name' => 'required|string|max:255',
        ];

        $request = Validator::make($request->all(), $rules);

        $this->generateTranslations(TranslationModels::CATEGORY, $category, 'category_id', $request);

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $code     = request()->get('code', getSessionLanguage());

        $setting        = Setting::first();
        $selected_theme = $setting->selected_theme;
        $languages      = allLanguages()->where('status', 1);

        return view('admin.category.edit_category', compact('category', 'selected_theme', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (request()->get('code') == allLanguages()->first()->code) {
            $rules = [
                'name'   => 'required|string|max:190',
                'slug'   => 'required|unique:categories,slug,' . $category->id,
                'status' => 'required',
            ];

            $customMessages = [
                'name.required' => __('Name is required'),
                'slug.required' => __('Slug is required'),
                'slug.unique'   => __('Slug already exist'),
            ];

            $this->validate($request, $rules, $customMessages);

            $category->slug   = $request->slug;
            $category->status = $request->status;

            if ($request->hasFile('icon')) {
                $category->icon = saveFileGetPath($request->icon, oldFile: $category->icon);
            }

            if ($request->hasFile('image')) {
                $category->image = saveFileGetPath($request->image, oldFile: $category->image);
            }

            $category->save();

            $request->validate([
                'name' => 'required|string|max:190',
            ], [
                'name.required' => __('Name is required'),
            ]);
            $this->updateTranslations(
                $category,
                $request,
                $request->only('name'),
            );

        } else {
            $request->validate([
                'name' => 'required|string|max:190',
            ], [
                'name.required' => __('Name is required'),
            ]);
            $this->updateTranslations(
                $category,
                $request,
                $request->only('name'),
            );
        }

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $category  = Category::find($id);
        $old_logo  = $category->icon;
        $old_image = $category->image;

        $category->translations()->each(function ($translation) {
            $translation->category()->dissociate();
            $translation->delete();
        });

        $category->delete();
        if ($old_logo) {
            if (File::exists(public_path() . '/' . $old_logo)) {
                unlink(public_path() . '/' . $old_logo);
            }

        }
        if ($old_image) {
            if (File::exists(public_path() . '/' . $old_image)) {
                unlink(public_path() . '/' . $old_image);
            }

        }

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $category = Category::find($id);
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
