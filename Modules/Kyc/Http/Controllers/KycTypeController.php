<?php

namespace Modules\Kyc\Http\Controllers;

use App\Facades\MailSender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kyc\Entities\KycInformation;
use Modules\Kyc\Entities\KycType;

class KycTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('kyc::Admin.Type.index', compact('kycType'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $customMessages = [
            'name.required' => __('Name is required'),
        ];

        $request->validate($rules, $customMessages);

        $kyctype         = new KycType();
        $kyctype->name   = $request->name;
        $kyctype->status = $request->status;
        $kyctype->save();

        $notification = __('Created Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
        ];

        $customMessages = [
            'name.required' => __('Name is required'),
        ];

        $request->validate($rules, $customMessages);

        $kyc         = KycType::find($id);
        $kyc->name   = $request->name;
        $kyc->status = $request->status;
        $kyc->save();

        $notification = __('Updated Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $kyc = KycType::find($id);
        $kyc->delete();

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param $id
     */
    public function DestroyKyc($id)
    {
        $kyc = KycInformation::find($id);
        $kyc->delete();

        $notification = __('Deleted Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function UpdateKycStatus(Request $request, $id)
    {
        $kyc         = KycInformation::find($id);
        $kyc->status = $request->status;
        $kyc->save();

        $influencer             = User::where('id', $kyc->user_id)->first();
        $influencer->kyc_status = $request->status;
        $influencer->save();

        $notification = __('Updated Successfully');

        $notification2 = match ((string) $kyc->status) {
            '0' => __('Your Account KYC Verification Is Pending'),
            '1' => __('Your Account Is Verified By KYC'),
            '2' => __('Your Account KYC Verification Is Rejected'),
            default => __('Your Account KYC Verification Is Pending'),
        };

        $subject = __('KYC Verification');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification2;

        MailSender::sendMail($influencer->email, $subject, $message);

        return redirect()->back()->with(['message' => $notification, 'alert-type' => 'success']);

    }

    public function kycList()
    {
        $kycs = KycInformation::orderBy('id', 'desc')->paginate(15);

        return view('kyc::Admin.kyc.index', compact('kycs'));
    }
}
