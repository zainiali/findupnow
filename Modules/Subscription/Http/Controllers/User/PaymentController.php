<?php

namespace Modules\Subscription\Http\Controllers\User;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\BreadcrumbImage;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\EmailTemplate;
use App\Models\Order;
use App\Models\Service;
use App\Models\Setting;
use App\Traits\GetGlobalInformationTrait;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\BasicPayment\app\Traits\PaymentTrait;
use Modules\GlobalSetting\app\Models\Setting as SettingModel;
use Modules\Subscription\Entities\PurchaseHistory;

class PaymentController extends Controller
{
    use PaymentTrait, GetGlobalInformationTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payment(Request $request, $slug)
    {
        $user = Auth::guard('web')->user();

        if ($user->is_provider == 1) {
            $notification = __('You are log-in as a provider, you can not book any service');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $request->validate([
            'name'       => 'required',
            'phone'      => 'required',
            'address'    => 'required',
            'agree_with' => 'required',
        ], [
            'name.required'       => __('Name is required'),
            'email.required'      => __('Email is required'),
            'phone.required'      => __('Phone is required'),
            'address.required'    => __('Address is required'),
            'agree_with.required' => __('Agree with terms and conditions is required'),
        ]);

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            abort(404);
        }

        if (SettingModel::where('key', 'commission_type')->first()->value !== 'commission' && $service->provider_id) {
            Session::put('order_provider_id', $service->provider_id);
        }

        $what_you_will_get = [];
        if ($service->what_you_will_provide) {
            $provides = json_decode($service->what_you_will_provide);
            foreach ($provides as $provide) {
                $what_you_will_get[] = $provide;
            }
        }

        $benifits = [];
        if ($service->benifit) {
            $exist_benifits = json_decode($service->benifit);
            foreach ($exist_benifits as $exist_benifit) {
                $benifits[] = $exist_benifit;
            }
        }

        $package_features = [];
        if ($service->package_features) {
            $features = json_decode($service->package_features);
            foreach ($features as $feature) {
                $package_features[] = $feature;
            }
        }

        $setting       = Setting::first();
        $currency_icon = (object) ['icon' => $setting->currency_icon];

        $customer = (object) [
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'post_code'  => $request->post_code,
            'order_note' => $request->order_note,
        ];

        $extras         = html_decode($request->extras);
        $extra_services = json_decode($extras);

        $extra_price = 0;
        if ($extra_services->ids) {
            foreach ($extra_services->ids as $index => $extra_service) {
                $addition = AdditionalService::find($extra_services->ids[$index]);
                $extra_price += ($extra_services->quantities[$index] * $addition->price);
            }
        }

        $total_price = $service->price + $extra_price;
        $total_price = round($total_price, 2);

        $order_info = (object) [
            'customer'           => $customer,
            'extras'             => $extras,
            'what_you_will_get'  => $what_you_will_get,
            'benifits'           => $benifits,
            'package_features'   => $package_features,
            'extra_price'        => $extra_price,
            'total_price'        => $total_price,
            'package_price'      => $service->price,
            'date'               => $extra_services->date,
            'schedule_time_slot' => $extra_services->schedule_time_slot,
        ];

        Session::put('order_info', $order_info);
        $user           = Auth::guard('web')->user();
        $paymentMethods = $this->getPaymentMethodsDetails();

        $coupon_discount = 0.0;

        if (Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount  = ($offer_percentage / 100) * $extra_services->total;
        }

        return view('subscription::user.payment')->with([
            'active_theme'      => getActiveThemeLayout(),
            'breadcrumb'        => $breadcrumb,
            'service'           => $service,
            'customer'          => $customer,
            'package_features'  => $package_features,
            'benifits'          => $benifits,
            'coupon_discount'   => $coupon_discount,
            'grand_total'       => $extra_services->total - $coupon_discount,
            'what_you_will_get' => $what_you_will_get,
            'extra_services'    => $extra_services,
            'currency_icon'     => $currency_icon,
            'user'              => $user,
            'paymentMethods'    => $paymentMethods,
        ]);

    }

    /**
     * @param $slug
     */
    public function check_schedule_during_payment($slug)
    {
        $service    = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            return response()->json(['is_available' => false, 'message' => $notification]);
        } else {
            return response()->json(['is_available' => true]);
        }

    }
    /**
     * @param  $service
     * @param  $date
     * @param  $schedule_id
     * @return mixed
     */
    public function checkAvaibalityBeforPayment($service, $date, $schedule_id)
    {
        $exist = Order::where(['provider_id' => $service->provider_id, 'appointment_schedule_id' => $schedule_id, 'booking_date' => $date])->count();
        return $exist;
    }

    /**
     * @param  $user
     * @param  $service
     * @param  $order_info
     * @param  $provider_id
     * @param  $client_id
     * @param  $payment_method
     * @param  $payment_status
     * @param  $tnx_info
     * @return mixed
     */
    private function createOrder($service, $order_info, $provider_id, $client_id, $payment_method, $payment_status = 'pending', $tnx_info = null)
    {
        $extra_services      = json_decode($order_info->extras);
        $additional_amount   = $order_info->extra_price;
        $additional_services = [];
        if ($extra_services->ids) {
            foreach ($extra_services->ids as $index => $extra_service) {
                $addition             = AdditionalService::find($extra_services->ids[$index]);
                $single_extra_service = [
                    'service_name' => $extra_services->names[$index],
                    'qty'          => $extra_services->quantities[$index],
                    'price'        => ($extra_services->quantities[$index] * $addition->price),
                ];
                $additional_services[] = $single_extra_service;
            }
        }

        $order_additional_services = json_encode($additional_services);
        $order_note                = $order_info->customer->order_note;
        $client_address            = $order_info->customer;

        $find_schedule = AppointmentSchedule::find($order_info->schedule_time_slot);
        $time_slot     = '';
        if ($find_schedule) {
            $time_slot = strtoupper(date('h:i A', strtotime($find_schedule->start_time))) . ' - ' . strtoupper(date('h:i A', strtotime($find_schedule->end_time)));
        }

        $coupon_discount = 0.00;
        if (Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount  = ($offer_percentage / 100) * ($service->price + $additional_amount);
        }

        // calculate amounts
        $servicePrice             = round($service->price, 2);
        $additionalAmount         = round($additional_amount, 2);
        $couponDiscount           = round($coupon_discount, 2);
        $totalAmount              = (($servicePrice + $additionalAmount) - $couponDiscount);
        $calculateAmount          = $this->calculatePayableCharge($totalAmount, $payment_method);
        $payableAmount            = round($calculateAmount->payable_with_charge, 2);
        $payableAmountWithoutRate = $totalAmount;
        $gatewayCharge            = round($calculateAmount->gateway_charge, 2);
        $payableCurrency          = getSessionCurrency();

        $order                              = new Order();
        $order->order_id                    = substr(rand(0, time()), 0, 10);
        $order->booking_date                = $order_info->date;
        $order->appointment_schedule_id     = $order_info->schedule_time_slot;
        $order->schedule_time_slot          = $time_slot;
        $order->client_id                   = $client_id;
        $order->provider_id                 = $provider_id;
        $order->service_id                  = $service->id;
        $order->package_amount              = $servicePrice;
        $order->additional_amount           = $additionalAmount;
        $order->coupon_discount             = $couponDiscount;
        $order->total_amount                = $totalAmount;
        $order->gateway_fee                 = $gatewayCharge;
        $order->payable_amount              = $payableAmount;
        $order->payable_amount_without_rate = $payableAmountWithoutRate;
        $order->payable_currency            = $payableCurrency;
        $order->payment_method              = $payment_method;
        $order->transection_id              = $tnx_info;
        $order->payment_status              = $payment_status;
        $order->order_status                = 'awaiting_for_provider_approval';
        $order->package_features            = $service->package_features;
        $order->additional_services         = $order_additional_services;
        $order->order_note                  = $order_note;
        $order->client_address              = json_encode($client_address);
        $order->save();

        if ($order->coupon_discount > 0 && Session::has('coupon_code')) {
            $coupon = Coupon::where(['coupon_code' => Session::get('coupon_code')])->first();

            if ($coupon) {
                $history                  = new CouponHistory();
                $history->user_id         = $client_id;
                $history->provider_id     = $coupon->provider_id;
                $history->coupon_code     = $coupon->coupon_code;
                $history->coupon_id       = $coupon->id;
                $history->discount_amount = $coupon_discount;
                $history->save();
            }
        }

        Session::forget('coupon_code');
        Session::forget('offer_percentage');

        return $order;
    }

    /**
     * @param $user
     * @param $order
     */
    public function sendMailToClient($user, $order)
    {
        try {
            MailHelper::setMailConfig();

            $setting = Setting::first();

            $template = EmailTemplate::where('id', 8)->first();
            $subject  = $template->subject;
            $message  = $template->message;
            $message  = str_replace('{{name}}', $user->name, $message);
            $message  = str_replace('{{amount}}', $setting->currency_icon . $order->total_amount, $message);
            $message  = str_replace('{{schedule_date}}', $order->booking_date, $message);
            $message  = str_replace('{{order_id}}', $order->order_id, $message);

            MailSender::sendMail($user->email, $subject, $message);
        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }

    /**
     * @param $provider
     * @param $order
     */
    public function sendMailToProvider($provider, $order)
    {
        try {
            MailHelper::setMailConfig();

            $setting = Setting::first();

            $template = EmailTemplate::where('id', 9)->first();
            $subject  = $template->subject;
            $message  = $template->message;
            $message  = str_replace('{{name}}', $provider->name, $message);
            $message  = str_replace('{{amount}}', $setting->currency_icon . $order->total_amount, $message);
            $message  = str_replace('{{schedule_date}}', $order->booking_date, $message);
            $message  = str_replace('{{order_id}}', $order->order_id, $message);

            MailSender::sendMail($provider->email, $subject, $message);
        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getPaymentMethodsDetails()
    {
        $paymentMethods = [];

        $paymentServiceInstance = app(PaymentMethodService::class);

        foreach ($paymentServiceInstance->getSupportedPayments() as $paymentMethod) {
            $paymentMethods[$paymentMethod] = (object) [
                'name'                => $paymentServiceInstance->getPaymentName($paymentMethod),
                'logo'                => $paymentServiceInstance->getLogo($paymentMethod),
                'currencies'          => $paymentServiceInstance->getSupportedCurrencies($paymentMethod),
                'status'              => $paymentServiceInstance->isActive($paymentMethod),
                'isCurrencySupported' => $paymentServiceInstance->isCurrencySupported($paymentMethod),
            ];
        }

        return $paymentMethods;
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function completeBooking(Request $request)
    {
        $request->validate([
            'slug'           => 'required',
            'payment_method' => 'required',
        ], [
            'slug.required'           => __('Service is required.'),
            'payment_method.required' => __('Please select a payment method.'),
        ]);

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->firstOrFail();

        $user = Auth::guard('web')->user();

        if (session()->has('order_info')) {
            $order_info = Session::get('order_info');
        } else {
            return redirect()->route('ready-to-booking', $service->slug)->with(['message' => __('Order details not found!'), 'alert-type' => 'error']);
        }

        $provider_id = $service->provider_id;
        $client_id   = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        if (array_key_exists($request->payment_method, $this->getPaymentMethodsDetails())) {
            $order = $this->createOrder($service, $order_info, $provider_id, $client_id, $request->payment_method);

            $provider = $service->provider;

            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            $this->afterSuccessOperations();

            return redirect()->route('user.sub.complete.payment', ['id' => $order->id, 'type' => 'order'])->with(['message' => __('Your order has been placed. Thanks for your new order'), 'alert-type' => 'success']);
        } else {
            $notification = __('Invalid Payment Method');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }
    }

    /**
     * @param $id
     * @param $type
     */
    public function completePayment($id, $type = 'order')
    {
        $data['purchase'] = $this->getPurchaseData($type, $id);

        $data['amount'] = $type == 'order' ? $data['purchase']->payable_amount : $data['purchase']->payable_amount;

        $data['currencyCode'] = $data['purchase']->payable_currency;

        $this->checkUnpaidStatus($data['purchase']);

        $data['type']            = $type;
        $data['orderId']         = $data['purchase']->id;
        $data['paymentViewPath'] = app(PaymentMethodService::class)->getBladeView($data['purchase']->payment_method);
        $data['breadcrumb']      = BreadcrumbImage::where(['id' => 8])->first();

        if (SettingModel::where('key', 'commission_type')->first()->value !== 'commission' && $type == 'order' && $data['purchase']->provider_id) {
            Session::put('order_provider_id', $data['purchase']->provider_id);
        }

        $data['active_theme'] = getActiveThemeLayout();

        $this->checkIsMethodActive($data['purchase']->payment_method);
        
        // Check if there's a registration return URL
        $returnUrl = session()->get('provider_registration_return_url');
        if ($returnUrl && $type == 'subscription') {
            // Set return URL for payment gateways
            Session::put('after_success_url', $returnUrl);
            Session::put('after_failed_url', $returnUrl);
            $data['return_url'] = $returnUrl;
        }

        return view('subscription::complete-payment', $data);
    }

    /**
     * @param $type
     */
    private function getPurchaseData($type, $id)
    {
        $getOrder = $type == 'order' ? Order::findOrFail($id) : PurchaseHistory::findOrFail($id);

        $type == 'order' ? session()->put('order_provider_id', $getOrder?->provider_id) : session()->forget('order_provider_id');

        return $getOrder;
    }

    /**
     * @param $method
     */
    public function checkIsMethodActive($method)
    {
        if (!app(PaymentMethodService::class)->isActive($method)) {
            if (request()->expectsJson()) {
                throw new HttpResponseException(response()->json(['message' => __('This payment method is not active'), 'alert-type' => 'error'], 422));
            } else {
                throw new HttpResponseException(redirect()->back()->with(['message' => __('This payment method is not active'), 'alert-type' => 'error']));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function getAmountConversion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'method' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $amount = $request->amount;
        $method = $request->method;

        $calculateAmount = $this->calculatePayableCharge($amount, $method);

        return response(view('subscription::user.grand-total', [
            'gatewayFee'  => $calculateAmount->gateway_charge,
            'grand_total' => $amount + $calculateAmount->gateway_charge,
        ])->render());
    }
}
