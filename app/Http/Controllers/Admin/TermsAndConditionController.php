<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use App\Models\TermsAndConditionTranslation;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $code = request()->filled('code') ? request()->code : getSessionLanguage();

        $termsAndCondition = TermsAndCondition::first();

        $isTermsCondition = $termsAndCondition ? true : false;

        if (TermsAndConditionTranslation::where([
            'terms_and_condition_id' => $termsAndCondition->id,
            'lang_code'              => $code,
        ])->doesntExist()) {
            $trans                         = new TermsAndConditionTranslation();
            $trans->terms_and_condition_id = $termsAndCondition->id;
            $trans->lang_code              = $code;
            $trans->privacy_policy         = $termsAndCondition->getTranslation('en')->privacy_policy;
            $trans->terms_and_condition    = $termsAndCondition->getTranslation('en')->terms_and_condition;
            $trans->save();
        }

        $languages = allLanguages();

        return view('admin.custom-pages.terms_and_condition', compact('termsAndCondition', 'isTermsCondition', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $termsAndCondition = TermsAndCondition::find($id);

        $rules = [
            'terms_and_condition' => 'required',
            'code'                => 'required',
        ];

        $customMessages = [
            'terms_and_condition.required' => __('Terms and condition is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $termsAndCondition = TermsAndConditionTranslation::where([
            'terms_and_condition_id' => $termsAndCondition->id,
            'lang_code'              => $request->code,
        ])->firstOrFail();

        $termsAndCondition->terms_and_condition = $request->terms_and_condition;
        $termsAndCondition->save();

        return redirect()->back()->with(
            [
                'message'    => __('Updated Successfully'),
                'alert-type' => 'success',
            ]
        );
    }

}
