<?php

namespace Modules\BasicPayment\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Modules\BasicPayment\app\Models\BasicPayment;
use Modules\BasicPayment\app\Models\PaymentGateway;
use Modules\Currency\app\Models\MultiCurrency;

class BasicPaymentController extends Controller
{
    public function basicpayment()
    {
        checkAdminHasPermissionAndThrowException('basic.payment.view');

        $payment_info = BasicPayment::get();

        $basic_payment = [];

        foreach ($payment_info as $payment_item) {
            $basic_payment[$payment_item->key] = $payment_item->value;
        }

        $basic_payment = (object) $basic_payment;

        $payment_info = PaymentGateway::get();

        $payment_setting = [];
        foreach ($payment_info as $payment_item) {
            $payment_setting[$payment_item->key] = $payment_item->value;
        }

        $payment_setting = (object) $payment_setting;

        $currencies = MultiCurrency::get();

        return view('basicpayment::index', compact('basic_payment', 'payment_setting', 'currencies'));
    }

    /**
     * @param Request $request
     */
    public function update_stripe(Request $request)
    {
        checkAdminHasPermissionAndThrowException('basic.payment.update');
        $rules = [
            'stripe_key'    => 'required',
            'stripe_secret' => 'required',
            'stripe_status' => 'required|in:inactive,active',
            'stripe_charge' => 'required|numeric',
        ];

        $customMessages = [
            'stripe_key.required'    => __('Stripe key is required'),
            'stripe_secret.required' => __('Stripe secret is required'),
        ];

        $request->validate($rules, $customMessages);

        if ($request->file('stripe_image')) {
            $this->updateImage($request->stripe_image, 'stripe_image');
        }

        $this->updateColumns($request->only('stripe_key', 'stripe_secret', 'stripe_status', 'stripe_charge'));

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_paypal(Request $request)
    {
        checkAdminHasPermissionAndThrowException('basic.payment.update');

        $rules = [
            'paypal_client_id'  => 'required',
            'paypal_secret_key' => 'required',
            'paypal_status'     => 'required|in:inactive,active',
            'paypal_charge'     => 'required|numeric',
        ];

        $customMessages = [
            'paypal_client_id.required'  => __('Client is required'),
            'paypal_secret_key.required' => __('Secret key is required'),
        ];

        $request->validate($rules, $customMessages);

        if ($request->file('paypal_image')) {
            $this->updateImage($request->paypal_image, 'paypal_image');
        }

        $this->updateColumns($request->only('paypal_client_id', 'paypal_secret_key', 'paypal_status', 'paypal_account_mode', 'paypal_charge'));

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     */
    public function update_bank_payment(Request $request)
    {
        checkAdminHasPermissionAndThrowException('basic.payment.update');

        $rules = [
            'bank_information' => 'required',
            'bank_status'      => 'required|in:inactive,active',
            'bank_charge'      => 'required|numeric',
        ];

        $customMessages = [
            'bank_information.required' => __('Bank information is required'),
        ];

        $request->validate($rules, $customMessages);

        if ($request->file('bank_image')) {
            $this->updateImage($request->bank_image, 'bank_image');
        }

        $this->updateColumns($request->only('bank_information', 'bank_status', 'bank_charge'));

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    /**
     * @param $request
     */
    private function updateColumns($request)
    {
        foreach ($request as $key => $value) {
            BasicPayment::where('key', $key)->update(['value' => $value]);
        }

        $this->put_basic_payment_cache();
    }

    /**
     * @param UploadedFile $image
     * @param string       $fieldName
     */
    private function updateImage(UploadedFile $image, string $fieldName)
    {
        $bank_setting = BasicPayment::where('key', $fieldName)->first();
        $basicImage   = $bank_setting ? $bank_setting?->value : null;
        if ($file_name = saveFileGetPath($image, 'uploads/custom-images/', $basicImage)) {
            $bank_setting->value = $file_name;
            $bank_setting->save();
        }
    }

    private function put_basic_payment_cache()
    {
        $payment_info  = BasicPayment::get();
        $basic_payment = [];
        foreach ($payment_info as $payment_item) {
            $basic_payment[$payment_item->key] = $payment_item->value;
        }
        $basic_payment = (object) $basic_payment;
        Cache::put('basic_payment', $basic_payment);
    }
}
