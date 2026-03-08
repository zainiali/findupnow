<?php

namespace Modules\Kyc\Http\Controllers\API;

use App\Facades\MailSender;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Kyc\Entities\KycInformation;
use Modules\Kyc\Entities\KycType;

class KycController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function kyc()
    {
        $influencer = Auth::guard('api')->user();

        $kyc     = KycInformation::where(['user_id' => $influencer->id])->first();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return response()->json([
            'kyc'     => $kyc,
            'kycType' => $kycType,
        ]);
    }

    /**
     * @param Request $request
     */
    public function kycSubmit(Request $request)
    {

        $influencer = Auth::guard('api')->user();

        $rules = [
            'kyc_id' => 'required',
            'file'   => 'required|mimes:jpg,jpeg,png,gif|max:2048', // max size 2MB
        ];
        $customMessages = [
            'kyc_id.required' => __('Type of is required'),
            'file.required'   => __('File is required'),
            'file.mimes'      => __('File must be a type of: jpg, jpeg, png, gif'),
            'file.max'        => __('File must be less than 2MB'),
        ];

        $request->validate($rules, $customMessages);

        $kyc = KycInformation::where(['user_id' => $influencer->id])->first();
        if ($kyc) {
            $notification = __('KYC Information Submitted Already');
            return response()->json(['message' => $notification], 403);
        }

        $kyc = new KycInformation();

        if ($request->file) {
            $extention  = $request->file->getClientOriginalExtension();
            $image_name = 'document' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
            $image_name = 'uploads/custom-images/' . $image_name;
            $request->file->move(public_path('uploads/custom-images/'), $image_name);
            $kyc->file = $image_name;
        }

        $kyc->kyc_id  = $request->kyc_id;
        $kyc->user_id = $influencer->id;
        $kyc->message = $request->message;
        $kyc->status  = 0;
        $kyc->save();

        $influencer->kyc_status = 0;
        $influencer->save();

        $notification = __('Information Submitted Successfully. Pls Wait for Conformation');

        $subject = __('KYC Verifaction');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification;

        MailSender::sendMail($influencer->email, $subject, $message);

        return response()->json(['message' => $notification], 403);

    }
}
