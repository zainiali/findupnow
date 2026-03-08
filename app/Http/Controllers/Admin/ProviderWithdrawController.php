<?php

namespace App\Http\Controllers\Admin;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\ProviderWithdraw;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProviderWithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $withdraws = ProviderWithdraw::with('provider')->orderBy('id', 'desc')->get();

        if ($request->provider_id) {
            $withdraws = $withdraws->where('user_id', $request->provider_id);
        }
        $setting = Setting::first();

        return view('admin.provider.provider_withdraw', compact('withdraws', 'setting'));
    }

    public function pendingProviderWithdraw()
    {
        $withdraws = ProviderWithdraw::orderBy('id', 'desc')->where('status', 0)->get();
        $setting   = Setting::first();
        return view('admin.provider.provider_withdraw', compact('withdraws', 'setting'));
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $setting  = Setting::first();
        $withdraw = ProviderWithdraw::find($id);
        return view('admin.provider.show_provider_withdraw', compact('withdraw', 'setting'));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $withdraw = ProviderWithdraw::find($id);
        $withdraw->delete();
        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.provider-withdraw')->with($notification);
    }

    /**
     * @param $id
     */
    public function approvedWithdraw($id)
    {
        $withdraw                = ProviderWithdraw::find($id);
        $withdraw->status        = 1;
        $withdraw->approved_date = date('Y-m-d');
        $withdraw->save();

        $setting = Setting::first();

        $user     = $withdraw->provider;
        $template = EmailTemplate::where('id', 5)->first();
        $message  = $template->message;
        $subject  = $template->subject;
        $message  = str_replace('{{provider_name}}', $user->name, $message);
        $message  = str_replace('{{withdraw_method}}', $withdraw->method, $message);
        $message  = str_replace('{{total_amount}}', $setting->currency_icon . $withdraw->total_amount, $message);
        $message  = str_replace('{{withdraw_charge}}', $setting->currency_icon . ($withdraw->total_amount - $withdraw->withdraw_amount), $message);
        $message  = str_replace('{{withdraw_amount}}', $setting->currency_icon . $withdraw->withdraw_amount, $message);
        $message  = str_replace('{{approval_date}}', $withdraw->approved_date, $message);

        MailHelper::setMailConfig();

        MailSender::sendMail($user->email, $subject, $message);

        $notification = __('Withdraw request approval successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.provider-withdraw')->with($notification);
    }
}
