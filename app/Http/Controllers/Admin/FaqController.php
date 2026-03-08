<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqTranslation;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $faqs = Faq::all();

        return view('admin.faq.faq', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create_faq');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
            'status'   => 'required',
        ], [
            'question.required' => __('Question is required'),
            'answer.required'   => __('Answer is required'),
            'status.required'   => __('Status is required'),
        ]);

        $faq         = new Faq();
        $faq->status = $request->status;
        $faq->save();

        foreach (allLanguages() as $lang) {
            $faqTr            = new FaqTranslation();
            $faqTr->faq_id    = $faq->id;
            $faqTr->lang_code = $lang->code;
            $faqTr->question  = $request->question;
            $faqTr->answer    = $request->answer;
            $faqTr->save();
        }

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.faq.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $code = request()->filled('code') ? request()->code : getSessionLanguage();

        $languages = allLanguages();

        $faq = Faq::findOrFail($id);

        return view('admin.faq.edit_faq', compact('faq', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $rules = [
            'question' => 'required',
            'answer'   => 'required',
            'status'   => 'required',
            'code'     => 'required',
        ];
        $customMessages = [
            'question.required' => __('Question is required'),
            'answer.required'   => __('Answer is required'),
        ];

        $request->validate($rules, $customMessages);

        $faq->status = $request->status;
        $faq->save();

        $faq = FaqTranslation::where([
            'faq_id'    => $id,
            'lang_code' => $request->code,
        ])->first();

        $faq->question = $request->question;
        $faq->answer   = $request->answer;
        $faq->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.faq.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        FaqTranslation::where('faq_id', $id)?->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.faq.index')->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $faq         = Faq::find($id);
        $faq->status = $faq->status == 1 ? 0 : 1;
        $faq->save();

        $message = $faq->status == 1 ? __('Active Successfully') : __('Inactive Successfully');
        return response()->json($message);
    }
}
