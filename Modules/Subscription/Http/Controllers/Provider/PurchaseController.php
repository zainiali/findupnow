<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use App\Facades\MailSender;
use App\Models\Gateway;
use App\Models\User;
use App\Traits\GetGlobalInformationTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\PurchaseHistory;
use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Http\Controllers\User\PaymentController as UserPaymentController;
use Redirect;

class PurchaseController extends Controller
{
    use GetGlobalInformationTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $auth_user = Auth::guard('web')->user();

        $histories = PurchaseHistory::with('provider')->orderBy('id', 'desc')->where('provider_id', $auth_user->id)->paginate(20);

        return view('subscription::provider.purchase_history', compact('histories'));
    }

    public function pending_payment()
    {
        $auth_user = Auth::guard('web')->user();

        $pageTitle = 'Pending Payment';

        $histories = PurchaseHistory::with('provider')->orderBy('id', 'desc')->where('payment_status', 'pending')->where('provider_id', $auth_user->id)->paginate(20);

        return view('subscription::provider.purchase_history', compact('histories'));
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        return view('subscription::provider.purchase_history_show', compact('history'));
    }

    public function subscription_plan()
    {

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial', 'asc')->get();

        return view('subscription::provider.subscription_plan', compact('plans'));
    }

    /**
     * @param $id
     */
    public function subscription_payment($id)
    {
        $user = Auth::guard('web')->user();

        if ($user->is_provider !== 1) {
            return to_route('subscription-plan')->with(['message' => __('Sorry! You are not a provider'), 'alert-type' => 'error']);
        }

        $plan = SubscriptionPlan::where('status', 1)->orderBy('serial', 'asc')->where('id', $id)->first();

        session()->forget('order_provider_id');
        
        // Check if there's a return URL (from registration flow)
        $returnUrl = request()->get('return_url');
        if ($returnUrl) {
            // Decode the URL if it's encoded
            $returnUrl = urldecode($returnUrl);
            session(['provider_registration_return_url' => $returnUrl]);
        }
        
        $paymentMethods = (new UserPaymentController)->getPaymentMethodsDetails();

        return view('subscription::provider.subscription_payment', compact('plan', 'user', 'paymentMethods'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function subscriptionOrderStore(Request $request, $id)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();

        if ($user->is_provider !== 1) {
            return to_route('subscription-plan')->with(['message' => __('Sorry! You are not a provider'), 'alert-type' => 'error']);
        }

        $plan = SubscriptionPlan::where([
            'status' => 1,
        ])->findOrFail($id);

        session()->forget('order_provider_id');

        $paymentMethods = (new UserPaymentController)->getPaymentMethodsDetails();

        if (array_key_exists($request->payment_method, $paymentMethods)) {
            $purchaseHistory = $this->store_subscription($user, $plan, $request->payment_method);

            // Check if there's a return URL for registration flow
            $returnUrl = session()->get('provider_registration_return_url') ?: $request->get('return_url');
            if ($returnUrl) {
                // Store plan in session for registration continuation
                session(['provider_registration_plan_id' => $plan->id]);
                session()->forget('provider_registration_return_url');
                
                $notification = __('Payment successful! You can now complete your profile.');
                return redirect($returnUrl)->with(['message' => $notification, 'alert-type' => 'success']);
            }

            $notification = __('Enrolled Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('user.sub.complete.payment', ['id' => $purchaseHistory->id, 'type' => 'subscription'])->with($notification);

        } else {
            $notification = __('Invalid Payment Method');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return back()->with($notification);
        }

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function free_enroll(Request $request, $id)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();

        if ($user->is_provider !== 1) {
            return to_route('subscription-plan')->with(['message' => __('Sorry! You are not a provider'), 'alert-type' => 'error']);
        }

        $free_exist = PurchaseHistory::where('provider_id', $user->id)->where(['payment_method' => 'Free'])->count();

        if ($free_exist == 0) {
            $plan = SubscriptionPlan::where([
                'status' => 1,
            ])->findOrFail($id);

            $this->store_subscription($user, $plan, 'Free', 'free_enroll', 'success');

            $notification = __('Enrolled Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('provider.purchase-history')->with($notification);

        } else {
            $notification = __('You have already enrolled trail version');

            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function bank_payment(Request $request, $id)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $transaction = $request->transaction;

        $user = Auth::guard('web')->user();

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        $this->store_subscription($user, $plan, 'Bank', $transaction, 'pending');

        $notification = __('Enrolled Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('provider.purchase-history')->with($notification);
    }

    /**
     * @param $user
     * @param $subscription_plan
     * @param $payment_gateway
     * @param $transaction
     * @param $payment_status
     * @param $bank_payment_proof
     */
    public function store_subscription($user, $subscription_plan, $payment_gateway, $transaction = null, $payment_status = 'pending', $bank_payment_proof = null)
    {
        $purchase = new PurchaseHistory();

        if ($subscription_plan->expiration_date == 'monthly') {
            $expiration_date = date('Y-m-d', strtotime('30 days'));
        } elseif ($subscription_plan->expiration_date == 'yearly') {
            $expiration_date = date('Y-m-d', strtotime('365 days'));
        } elseif ($subscription_plan->expiration_date == 'lifetime') {
            $expiration_date = 'lifetime';
        }

        if ($payment_status == 'success') {
            PurchaseHistory::where('provider_id', $user->id)->update(['status' => 'expired']);
        }

        $totalAmount = $subscription_plan->plan_price;

        if ($totalAmount == 0) {
            $payableAmount            = $totalAmount;
            $payableAmountWithoutRate = $totalAmount;
            $gatewayCharge            = round(0.00, 2);
            $payableCurrency          = 'USD';
        } else {
            $calculateAmount          = $this->calculatePayableCharge($totalAmount, $payment_gateway);
            $payableAmount            = round($calculateAmount->payable_with_charge, 2);
            $payableAmountWithoutRate = $totalAmount;
            $gatewayCharge            = round($calculateAmount->gateway_charge, 2);
            $payableCurrency          = getSessionCurrency();
        }

        $purchase->provider_id                 = $user->id;
        $purchase->plan_id                     = $subscription_plan->id;
        $purchase->plan_name                   = $subscription_plan->plan_name;
        $purchase->plan_price                  = $subscription_plan->plan_price;
        $purchase->expiration                  = $subscription_plan->expiration_date;
        $purchase->expiration_date             = $expiration_date;
        $purchase->maximum_service             = $subscription_plan->maximum_service;
        $purchase->status                      = $payment_status == 'success' ? 'active' : 'pending';
        $purchase->payment_method              = $payment_gateway;
        $purchase->payment_status              = $payment_status;
        $purchase->gateway_fee                 = $gatewayCharge;
        $purchase->total_amount                = $totalAmount;
        $purchase->payable_amount              = $payableAmount;
        $purchase->payable_amount_without_rate = $payableAmountWithoutRate;
        $purchase->payable_currency            = $payableCurrency;
        $purchase->transaction                 = $transaction;
        $purchase->save();

        $subject = 'Subscription Plan Purchased';
        $message = "You have successfully purchased {$subscription_plan->plan_name} subscription plan for the price of {$payableAmount} {$payableCurrency} and your payment status is {$payment_status}.";

        MailSender::sendMail($user->email, $subject, $message);

        return $purchase;
    }

}
