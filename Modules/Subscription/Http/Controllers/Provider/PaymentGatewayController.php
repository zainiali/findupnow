<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use App\Models\User;
use App\Traits\NewUserCreateTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{
    use NewUserCreateTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * @return mixed
     */
    public function paypal_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $paypal = (object) [
            'paypal_client_id'    => $auth_user->providerGateways->where('key', 'paypal_client_id')->first()->value,
            'paypal_secret_key'   => $auth_user->providerGateways->where('key', 'paypal_secret_key')->first()->value,
            'paypal_status'       => $auth_user->providerGateways->where('key', 'paypal_status')->first()->value,
            'paypal_account_mode' => $auth_user->providerGateways->where('key', 'paypal_account_mode')->first()->value,
            'paypal_app_id'       => $auth_user->providerGateways->where('key', 'paypal_app_id')->first()->value,
            'paypal_image'        => $auth_user->providerGateways->where('key', 'paypal_image')->first()->value,
        ];

        return view('subscription::provider.paypal_gateway', compact('paypal'));
    }

    /**
     * @param Request $request
     */
    public function store_paypal_gateway(Request $request)
    {

        $request->validate([
            'paypal_client_id'  => 'required_if:paypal_status,active',
            'paypal_secret_key' => 'required_if:paypal_status,active',
            'paypal_status'     => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'paypal_client_id')->first()->update([
            'value' => $request->paypal_client_id,
        ]);

        $auth_user->providerGateways->where('key', 'paypal_secret_key')->first()->update([
            'value' => $request->paypal_secret_key,
        ]);

        $auth_user->providerGateways->where('key', 'paypal_status')->first()->update([
            'value' => $request->paypal_status,
        ]);

        $auth_user->providerGateways->where('key', 'paypal_account_mode')->first()->update([
            'value' => 'live',
        ]);

        $notification = __('Data Save successfully');

        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function stripe_gateway()
    {

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $stripe = (object) [
            'stripe_key'    => $auth_user->providerGateways->where('key', 'stripe_key')->first()->value,
            'stripe_secret' => $auth_user->providerGateways->where('key', 'stripe_secret')->first()->value,
            'stripe_status' => $auth_user->providerGateways->where('key', 'stripe_status')->first()->value,
            'stripe_image'  => $auth_user->providerGateways->where('key', 'stripe_image')->first()->value,
        ];

        return view('subscription::provider.stripe_gateway', compact('stripe'));
    }

    /**
     * @param Request $request
     */
    public function store_stripe_gateway(Request $request)
    {

        $request->validate([
            'stripe_key'    => 'required_if:stripe_status,active',
            'stripe_secret' => 'required_if:stripe_status,active',
            'stripe_status' => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        $auth_user->providerGateways->where('key', 'stripe_key')->first()->update([
            'value' => $request->stripe_key,
        ]);

        $auth_user->providerGateways->where('key', 'stripe_secret')->first()->update([
            'value' => $request->stripe_secret,
        ]);

        $auth_user->providerGateways->where('key', 'stripe_status')->first()->update([
            'value' => $request->stripe_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function razorpay_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $razorpay = (object) [
            'razorpay_key'    => $auth_user->providerGateways->where('key', 'razorpay_key')->first()->value,
            'razorpay_secret' => $auth_user->providerGateways->where('key', 'razorpay_secret')->first()->value,
            'razorpay_status' => $auth_user->providerGateways->where('key', 'razorpay_status')->first()->value,
            'razorpay_image'  => $auth_user->providerGateways->where('key', 'razorpay_image')->first()->value,
        ];

        return view('subscription::provider.razorpay_gateway', compact('razorpay'));
    }

    /**
     * @param Request $request
     */
    public function store_razorpay_gateway(Request $request)
    {

        $request->validate([
            'razorpay_key'    => 'required_if:razorpay_status,active',
            'razorpay_secret' => 'required_if:razorpay_status,active',
            'razorpay_status' => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'razorpay_key')->first()->update([
            'value' => $request->razorpay_key,
        ]);

        $auth_user->providerGateways->where('key', 'razorpay_secret')->first()->update([
            'value' => $request->razorpay_secret,
        ]);

        $auth_user->providerGateways->where('key', 'razorpay_status')->first()->update([
            'value' => $request->razorpay_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function flutterwave_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $flutterwave = (object) [
            'flutterwave_public_key' => $auth_user->providerGateways->where('key', 'flutterwave_public_key')->first()->value,
            'flutterwave_secret_key' => $auth_user->providerGateways->where('key', 'flutterwave_secret_key')->first()->value,
            'flutterwave_status'     => $auth_user->providerGateways->where('key', 'flutterwave_status')->first()->value,
            'flutterwave_image'      => $auth_user->providerGateways->where('key', 'flutterwave_image')->first()->value,
        ];

        return view('subscription::provider.flutterwave_gateway', compact('flutterwave'));
    }

    /**
     * @param Request $request
     */
    public function store_flutterwave_gateway(Request $request)
    {

        $request->validate([
            'flutterwave_public_key' => 'required_if:flutterwave_status,active',
            'flutterwave_secret_key' => 'required_if:flutterwave_status,active',
            'flutterwave_status'     => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'flutterwave_public_key')->first()->update([
            'value' => $request->flutterwave_public_key,
        ]);

        $auth_user->providerGateways->where('key', 'flutterwave_secret_key')->first()->update([
            'value' => $request->flutterwave_secret_key,
        ]);

        $auth_user->providerGateways->where('key', 'flutterwave_status')->first()->update([
            'value' => $request->flutterwave_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function paystack_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $paystack = (object) [
            'paystack_public_key' => $auth_user->providerGateways->where('key', 'paystack_public_key')->first()->value,
            'paystack_secret_key' => $auth_user->providerGateways->where('key', 'paystack_secret_key')->first()->value,
            'paystack_status'     => $auth_user->providerGateways->where('key', 'paystack_status')->first()->value,
            'paystack_image'      => $auth_user->providerGateways->where('key', 'paystack_image')->first()->value,
        ];

        return view('subscription::provider.paystack_gateway', compact('paystack'));
    }

    /**
     * @param Request $request
     */
    public function store_paystack_gateway(Request $request)
    {

        $request->validate([
            'paystack_public_key' => 'required_if:paystack_status,active',
            'paystack_secret_key' => 'required_if:paystack_status,active',
            'paystack_status'     => 'required',
        ], [
            'paystack_public_key.required' => __('Public key is required'),
            'paystack_secret_key.required' => __('Secret key is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'paystack_public_key')->first()->update([
            'value' => $request->paystack_public_key,
        ]);

        $auth_user->providerGateways->where('key', 'paystack_secret_key')->first()->update([
            'value' => $request->paystack_secret_key,
        ]);

        $auth_user->providerGateways->where('key', 'paystack_status')->first()->update([
            'value' => $request->paystack_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function mollie_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $mollie = (object) [
            'mollie_key'    => $auth_user->providerGateways->where('key', 'mollie_key')->first()->value,
            'mollie_status' => $auth_user->providerGateways->where('key', 'mollie_status')->first()->value,
            'mollie_image'  => $auth_user->providerGateways->where('key', 'mollie_image')->first()->value,
        ];

        return view('subscription::provider.mollie_gateway', compact('mollie'));
    }

    /**
     * @param Request $request
     */
    public function store_mollie_gateway(Request $request)
    {

        $request->validate([
            'mollie_key'    => 'required_if:mollie_status,active',
            'mollie_status' => 'required',
        ], [
            'mollie_key.required' => __('Mollie key is required'),

        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'mollie_key')->first()?->update([
            'value' => $request->mollie_key,
        ]);

        $auth_user->providerGateways->where('key', 'mollie_status')->first()?->update([
            'value' => $request->mollie_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function instamojo_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $instamojo = (object) [
            'instamojo_client_id'     => $auth_user->providerGateways->where('key', 'instamojo_client_id')->first()->value,
            'instamojo_client_secret' => $auth_user->providerGateways->where('key', 'instamojo_client_secret')->first()->value,
            'instamojo_image'         => $auth_user->providerGateways->where('key', 'instamojo_image')->first()->value,
            'instamojo_status'        => $auth_user->providerGateways->where('key', 'instamojo_status')->first()->value,
        ];

        return view('subscription::provider.instamojo_gateway', compact('instamojo'));
    }

    /**
     * @param Request $request
     */
    public function store_instamojo_gateway(Request $request)
    {

        $request->validate([
            'instamojo_client_id'     => 'required_if:instamojo_status,active',
            'instamojo_client_secret' => 'required_if:instamojo_status,active',
            'instamojo_status'        => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'instamojo_client_id')->first()?->update([
            'value' => $request->instamojo_client_id,
        ]);

        $auth_user->providerGateways->where('key', 'instamojo_client_secret')->first()?->update([
            'value' => $request->instamojo_client_secret,
        ]);

        $auth_user->providerGateways->where('key', 'instamojo_status')->first()?->update([
            'value' => $request->instamojo_status,
        ]);

        $auth_user->providerGateways->where('key', 'instamojo_account_mode')->first()?->update([
            'value' => 'live',
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function bank_handcash_gateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $bank_handcash = (object) [
            'bank_information' => $auth_user->providerGateways->where('key', 'bank_information')->first()->value,
            'bank_image'       => $auth_user->providerGateways->where('key', 'bank_image')->first()->value,
            'bank_status'      => $auth_user->providerGateways->where('key', 'bank_status')->first()->value,
        ];

        return view('subscription::provider.bank_handcash_gateway', compact('bank_handcash'));
    }

    /**
     * @param Request $request
     */
    public function store_bank_handcash_gateway(Request $request)
    {

        $request->validate([
            'bank_status'      => 'required',
            'bank_information' => 'required_if:bank_status,active',
        ], [
            'bank_information.required' => __('Bank instruction is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'bank_information')->first()?->update([
            'value' => $request->bank_information,
        ]);

        $auth_user->providerGateways->where('key', 'bank_status')->first()?->update([
            'value' => $request->bank_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    public function sslcommerzGateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $sslcommerz = (object) [
            'sslcommerz_store_id'       => $auth_user->providerGateways->where('key', 'sslcommerz_store_id')->first()->value,
            'sslcommerz_store_password' => $auth_user->providerGateways->where('key', 'sslcommerz_store_password')->first()->value,
            'sslcommerz_status'         => $auth_user->providerGateways->where('key', 'sslcommerz_status')->first()->value,
            'sslcommerz_image'          => $auth_user->providerGateways->where('key', 'sslcommerz_image')->first()->value,
        ];

        return view('subscription::provider.sslcommerz_gateway', compact('sslcommerz'));
    }

    /**
     * @param Request $request
     */
    public function storeSslcommerzGateway(Request $request)
    {

        $request->validate([
            'sslcommerz_store_id'       => 'required_if:sslcommerz_status,active',
            'sslcommerz_store_password' => 'required_if:sslcommerz_status,active',
            'sslcommerz_status'         => 'required',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'sslcommerz_store_id')->first()?->update([
            'value' => $request->sslcommerz_store_id,
        ]);

        $auth_user->providerGateways->where('key', 'sslcommerz_store_password')->first()?->update([
            'value' => $request->sslcommerz_store_password,
        ]);

        $auth_user->providerGateways->where('key', 'sslcommerz_status')->first()?->update([
            'value' => $request->sslcommerz_status,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function coinGateGateway()
    {
        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $coinGate = (object) [
            'crypto_api_key'          => $auth_user->providerGateways->where('key', 'crypto_api_key')->first()->value,
            'crypto_status'           => $auth_user->providerGateways->where('key', 'crypto_status')->first()->value,
            'crypto_receive_currency' => $auth_user->providerGateways->where('key', 'crypto_receive_currency')->first()->value,
        ];

        return view('subscription::provider.coin_gate_gateway', compact('coinGate'));
    }

    /**
     * @param Request $request
     */
    public function storeCoinGateGateway(Request $request)
    {
        $request->validate([
            'crypto_api_key'          => 'required_if:crypto_status,active',
            'crypto_status'           => 'required',
            'crypto_receive_currency' => 'required_if:crypto_status,active',
        ]);

        $auth_user = Auth::guard('web')->user();

        static::addProviderGateways($auth_user);

        $auth_user->providerGateways->where('key', 'crypto_api_key')->first()?->update([
            'value' => $request->crypto_api_key,
        ]);

        $auth_user->providerGateways->where('key', 'crypto_status')->first()?->update([
            'value' => $request->crypto_status,
        ]);

        $auth_user->providerGateways->where('key', 'crypto_receive_currency')->first()?->update([
            'value' => $request->crypto_receive_currency,
        ]);

        $notification = __('Data Save successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

}
