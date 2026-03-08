<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\HowItWork;
use App\Models\HowItWorkTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $code = request()->filled('code') ? request()->code : getSessionLanguage();

        $about = AboutUs::first();

        if (AboutUsTranslation::where([
            'about_us_id' => $about->id,
            'lang_code'   => $code,
        ])->doesntExist()) {
            $trans                        = new AboutUsTranslation();
            $trans->about_us_id           = $about->id;
            $trans->lang_code             = $code;
            $trans->header                = $about->getTranslation('en')->header;
            $trans->header_description    = $about->getTranslation('en')->header_description;
            $trans->about_us_title        = $about->getTranslation('en')->about_us_title;
            $trans->about_us              = $about->getTranslation('en')->about_us;
            $trans->why_choose_us_title   = $about->getTranslation('en')->why_choose_us_title;
            $trans->why_choose_desciption = $about->getTranslation('en')->why_choose_desciption;
            $trans->title_one             = $about->getTranslation('en')->title_one;
            $trans->description_one       = $about->getTranslation('en')->description_one;
            $trans->title_two             = $about->getTranslation('en')->title_two;
            $trans->description_two       = $about->getTranslation('en')->description_two;
            $trans->title_three           = $about->getTranslation('en')->title_three;
            $trans->description_three     = $about->getTranslation('en')->description_three;
            $trans->save();
        }

        $how_it_works = HowItWork::with('translation')->get();

        foreach ($how_it_works as $how_it_work) {
            if (HowItWorkTranslation::where([
                'how_it_work_id' => $how_it_work->id,
                'lang_code'      => $code,
            ])->doesntExist()) {
                $trans                 = new HowItWorkTranslation();
                $trans->how_it_work_id = $how_it_work->id;
                $trans->lang_code      = $code;
                $trans->title          = $how_it_work->getTranslation('en')->title;
                $trans->description    = $how_it_work->getTranslation('en')->description;
                $trans->save();
            }
        }

        $about_us_section = [
            'about_us_title'     => $about->getTranslation($code)->about_us_title,
            'about_us'           => $about->getTranslation($code)->about_us,
            'foreground_image'   => $about->foreground_image,
            'background_image'   => $about->background_image,
            'client_image_one'   => $about->small_image_one,
            'client_image_two'   => $about->small_image_two,
            'client_image_three' => $about->small_image_three,
            'total_rating'       => $about->total_rating,
        ];

        $why_choose_us = [
            'why_choose_us_title'   => $about->getTranslation($code)->why_choose_us_title,
            'why_choose_desciption' => $about->getTranslation($code)->why_choose_desciption,
            'background_image'      => $about->why_choose_background,
            'foreground_image'      => $about->why_choose_foreground,
            'item_one'              => $about->getTranslation($code)->title_one,
            'item_two'              => $about->getTranslation($code)->title_two,
            'item_three'            => $about->getTranslation($code)->title_three,
            'description_one'       => $about->getTranslation($code)->description_one,
            'description_two'       => $about->getTranslation($code)->description_two,
            'description_three'     => $about->getTranslation($code)->description_three,
        ];

        $languages = allLanguages();

        return view('admin.about-us.about-us', compact('about', 'how_it_works', 'about_us_section', 'why_choose_us', 'languages', 'code'));
    }

    /**
     * @param Request $request
     */
    public function addNewHotItWork(Request $request)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
            'image.required'       => __('Image is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $item = new HowItWork();

        if ($request->hasFile('image')) {
            $item->image = saveFileGetPath($request->image);
        }

        $item->save();

        foreach (allLanguages() as $lang) {
            $newTrans                 = new HowItWorkTranslation();
            $newTrans->how_it_work_id = $item->id;
            $newTrans->lang_code      = $lang->code;
            $newTrans->title          = $request->title;
            $newTrans->description    = $request->description;
            $newTrans->save();
        }

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateHotItWork(Request $request, $id)
    {
        $rules = [
            'title'       => 'required',
            'description' => 'required',
            'code'        => 'required',
        ];
        $customMessages = [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $item = HowItWork::find($id);

        if ($request->hasFile('image')) {
            $item->image = saveFileGetPath($request->image, oldFile: $item->image);
            $item->save();
        }

        $c = $item;

        $item = HowItWorkTranslation::where([
            'how_it_work_id' => $c->id,
            'lang_code'      => $request->code,
        ])->first();

        $item->title       = $request->title;
        $item->description = $request->description;
        $item->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function deleteHotItWork($id)
    {

        DB::transaction(function () use ($id) {
            $item = HowItWork::find($id);

            if ($item->image) {
                $exist_banner = $item->image;
                if ($exist_banner && File::exists(public_path() . '/' . $exist_banner)) {
                    unlink(public_path() . '/' . $exist_banner);
                }
            }

            $item->delete();

            HowItWorkTranslation::where('how_it_work_id', $id)?->delete();
        });

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function updateHeader(Request $request)
    {
        $rules = [
            'header'             => 'required',
            'header_description' => 'required',
            'code'               => 'required',
        ];
        $customMessages = [
            'header.required'             => __('Header is required'),
            'header_description.required' => __('Header Description is required'),
            'code.required'               => __('Code is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $about = AboutUsTranslation::where([
            'about_us_id' => AboutUs::first()->id,
            'lang_code'   => $request->code,
        ])->first();

        $about->header             = $request->header;
        $about->header_description = $request->header_description;
        $about->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function updateAboutUs(Request $request)
    {
        $rules = [
            'about_us_title' => 'required',
            'about_us'       => 'required',
            'code'           => 'required',
        ];
        $customMessages = [
            'about_us_title.required' => __('About us title is required'),
            'about_us.required'       => __('About us is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $aboutNT = AboutUs::first();

        $about = AboutUsTranslation::where([
            'about_us_id' => $aboutNT->id,
            'lang_code'   => $request->code,
        ])->first();

        $about->about_us_title = $request->about_us_title;
        $about->about_us       = $request->about_us;
        $about->save();

        $about               = $aboutNT;
        $about->total_rating = $request->total_rating;

        if ($request->hasFile('background_image')) {
            $about->background_image = saveFileGetPath($request->background_image, oldFile: $about->background_image);
        }

        if ($request->hasFile('foreground_image')) {
            $about->foreground_image = saveFileGetPath($request->foreground_image, oldFile: $about->foreground_image);
        }

        if ($request->hasFile('client_image_one')) {
            $about->small_image_one = saveFileGetPath($request->client_image_one, oldFile: $about->small_image_one);
        }

        if ($request->hasFile('client_image_two')) {
            $about->small_image_two = saveFileGetPath($request->client_image_two, oldFile: $about->small_image_two);
        }

        if ($request->hasFile('client_image_three')) {
            $about->small_image_three = saveFileGetPath($request->client_image_three, oldFile: $about->small_image_three);
        }

        $about->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function updateWhyChooseUs(Request $request)
    {
        $rules = [
            'why_choose_us_title'   => 'required',
            'why_choose_desciption' => 'required',
            'code'                  => 'required',
        ];
        $customMessages = [
            'why_choose_us_title.required'   => __('Title is required'),
            'why_choose_desciption.required' => __('Description is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $aboutNT = AboutUs::first();

        $about = AboutUsTranslation::where([
            'about_us_id' => $aboutNT->id,
            'lang_code'   => $request->code,
        ])->first();

        $about->why_choose_us_title   = $request->why_choose_us_title;
        $about->why_choose_desciption = $request->why_choose_desciption;
        $about->title_one             = $request->item_one;
        $about->title_two             = $request->item_two;
        $about->title_three           = $request->item_three;
        $about->description_one       = $request->description_one;
        $about->description_two       = $request->description_two;
        $about->description_three     = $request->description_three;
        $about->save();

        if ($request->hasFile('background_image')) {
            $aboutNT->why_choose_background = saveFileGetPath($request->background_image, oldFile: $about->why_choose_background);
        }

        if ($request->hasFile('foreground_image')) {
            $aboutNT->why_choose_foreground = saveFileGetPath($request->foreground_image, oldFile: $about->why_choose_foreground);
        }

        $aboutNT->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}
