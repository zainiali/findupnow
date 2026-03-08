<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use App\Models\Gateway;
use App\Models\PaypalPayment;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\PurchaseHistory;
use Modules\Subscription\Entities\SubscriptionPlan;
use Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * @param $id
     */
    public function paypal_payment($id)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        $user = Auth::guard('web')->user();

        $paypal_account = PaypalPayment::first();
        $payableAmount  = round($plan->plan_price * $paypal_account->currency_rate, 2);

        Session::put('plan_id', $id);
        Session::put('pricing_plan', $plan);

        config(['paypal.mode' => $paypal_account->account_mode]);

        if ($paypal_account->account_mode == 'sandbox') {
            config(['paypal.sandbox.client_id' => $paypal_account->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_account->secret_id]);
        } else {
            config(['paypal.sandbox.client_id' => $paypal_account->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_account->secret_id]);
            config(['paypal.sandbox.app_id' => 'APP-80W284485P519543T']);
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response    = $provider->createOrder([
            "intent"              => "CAPTURE",
            "application_context" => [
                "return_url" => route('provider.subscription.paypal-success-payment'),
                "cancel_url" => route('provider.subscription.paypal-faild-payment'),
            ],
            "purchase_units"      => [
                0 => [
                    "amount" => [
                        "currency_code" => $paypal_account->currency_code,
                        "value"         => $payableAmount,
                    ],
                ],
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            $notification = __('Something went wrong');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);

        } else {
            $notification = __('Something went wrong');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

    }

    /**
     * @param Request $request
     */
    public function paypal_success_payment(Request $request)
    {

        $paypal_account = PaypalPayment::first();
        config(['paypal.mode' => $paypal_account->account_mode]);

        if ($paypal_account->account_mode == 'sandbox') {
            config(['paypal.sandbox.client_id' => $paypal_account->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_account->secret_id]);
        } else {
            config(['paypal.sandbox.client_id' => $paypal_account->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_account->secret_id]);
            config(['paypal.sandbox.app_id' => 'APP-80W284485P519543T']);
        }

        $pricing_plan = Session::get('pricing_plan');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $transaction = $request->PayerID;

            $user = Auth::guard('web')->user();

            $this->store_subscription($user, $pricing_plan, 'Paypal', $transaction, 'success');

            $notification = __('Enrolled Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('provider.purchase-history')->with($notification);

        } else {

            $notification = __('Something went wrong');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('user.subscription-payment', $$pricing_plan->id)->with($notification);

        }

    }

    public function paypal_faild_payment()
    {

        $plan_id = Session::get('plan_id');

        $notification = __('Something went wrong');
        $notification = ['message' => $notification, 'alert-type' => 'error'];
        return redirect()->route('user.subscription-payment', $plan_id)->with($notification);

    }

    /**
     * @param $user
     * @param $subscription_plan
     * @param $payment_gateway
     * @param $transaction
     * @param $payment_status
     * @param array                $bank_payment_proof
     */
    public function store_subscription($user, $subscription_plan, $payment_gateway, $transaction, $payment_status, $bank_payment_proof = [])
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

        $purchase->provider_id     = $user->id;
        $purchase->plan_id         = $subscription_plan->id;
        $purchase->plan_name       = $subscription_plan->plan_name;
        $purchase->plan_price      = $subscription_plan->plan_price;
        $purchase->expiration      = $subscription_plan->expiration_date;
        $purchase->expiration_date = $expiration_date;
        $purchase->maximum_service = $subscription_plan->maximum_service;
        if ($payment_status == 'success') {
            $purchase->status = 'active';
        } else {
            $purchase->status = 'pending';
        }

        $purchase->payment_method = $payment_gateway;
        $purchase->payment_status = $payment_status;
        $purchase->transaction    = $transaction;
        $purchase->save();

    }

}
