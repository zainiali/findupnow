<?php

namespace Modules\Kyc\Http\Controllers;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Kyc\Entities\KycInformation;
use Modules\Kyc\Entities\KycType;

class KycController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function kyc()
    {
        $influencer = Auth::guard('web')->user();

        $kyc     = KycInformation::where(['user_id' => $influencer->id])->first();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('kyc::User.kyc.index', compact('kyc', 'kycType'));
    }

    /**
     * @param Request $request
     */
    public function kycSubmit(Request $request)
    {
        $influencer = Auth::guard('web')->user();

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

        $kyc = new KycInformation();

        if ($request->hasFile('file')) {
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

        $user = User::where('id', $influencer->id)->first();

        $notification = __('Information submitted successfully. Please wait for conformation');

        MailHelper::setMailConfig();

        $subject = __('KYC Verification');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification;

        // note-by-dev-abir on 21-1-2025
        // this mail was sending to "rashed4pa@gmail.com", but i don't know why it was sending to this email!

        MailSender::sendMail($user->email, $subject, $message);

        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

}
