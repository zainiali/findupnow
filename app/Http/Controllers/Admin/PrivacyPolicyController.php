<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use App\Models\TermsAndConditionTranslation;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $code      = request()->filled('code') ? request()->code : getSessionLanguage();
        $languages = allLanguages();

        $privacyPolicy   = TermsAndCondition::first();
        $isPrivacyPolicy = $privacyPolicy ? true : false;

        if (TermsAndConditionTranslation::where([
            'terms_and_condition_id' => $privacyPolicy->id,
            'lang_code'              => $code,
        ])->doesntExist()) {
            $trans                         = new TermsAndConditionTranslation();
            $trans->terms_and_condition_id = $privacyPolicy->id;
            $trans->lang_code              = $code;
            $trans->privacy_policy         = $privacyPolicy->getTranslation('en')->privacy_policy;
            $trans->terms_and_condition    = $privacyPolicy->getTranslation('en')->terms_and_condition;
            $trans->save();
        }

        return view('admin.custom-pages.privacy_policy', compact('privacyPolicy', 'isPrivacyPolicy', 'languages', 'code'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $privacyPolicy = TermsAndCondition::find($id);

        $rules = [
            'privacy_policy' => 'required',
            'code'           => 'required',
        ];
        $customMessages = [
            'privacy_policy.required' => __('Privacy policy is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $privacyPolicy = TermsAndConditionTranslation::where([
            'terms_and_condition_id' => $privacyPolicy->id,
            'lang_code'              => $request->code,
        ])->firstOrFail();

        $privacyPolicy->privacy_policy = $request->privacy_policy;
        $privacyPolicy->save();

        return redirect()->back()->with(
            [
                'message'    => __('Updated Successfully'),
                'alert-type' => 'success',
            ]
        );
    }
}
