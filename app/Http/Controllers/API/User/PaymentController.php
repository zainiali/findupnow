<?php

namespace App\Http\Controllers\API\User;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\BreadcrumbImage;
use App\Models\EmailTemplate;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\Currency\app\Models\MultiCurrency;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentController extends Controller
{
    /**
     * @var mixed
     */
    private $paymentService;

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    }

    /**
     * @param $slug
     */
    public function ready_to_booking($slug)
    {
        $currency = getApiCurrencyCode(true);

        if (!$currency) {
            return response()->json(['message' => __('Currency not found')], 403);
        }

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            return response()->json(['message' => __('user.Service Not Found')], 403);
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

        $additional_services = AdditionalService::where('service_id', $service->id)->get();

        $currency_icon = (object) ['icon' => $currency->currency_icon];

        return response()->json([
            'breadcrumb'          => $breadcrumb,
            'service'             => $service,
            'package_features'    => $package_features,
            'benifits'            => $benifits,
            'additional_services' => $additional_services,
            'currency_icon'       => $currency_icon,
            'what_you_will_get'   => $what_you_will_get,
        ]);
    }

    /**
     * @param Request $request
     */
    public function get_available_schedule(Request $request)
    {
        $rules = [
            'date'        => 'required',
            'provider_id' => 'required',
        ];

        $this->validate($request, $rules);

        $day                   = date('l', strtotime($request->date));
        $appointment_schedules = AppointmentSchedule::where(['user_id' => $request->provider_id, 'day' => $day])->where('status', 1)->get();

        $available_schedule_arr = [];
        foreach ($appointment_schedules as $appointment_schedule) {
            $exist = Order::where(['provider_id' => $request->provider_id, 'appointment_schedule_id' => $appointment_schedule->id, 'booking_date' => $request->date])->count();
            if ($exist == 0) {
                $available_schedule_arr[] = $appointment_schedule->id;
            }
        }

        $available_schedules = AppointmentSchedule::whereIn('id', $available_schedule_arr)->where('status', 1)->orderBy('start_time', 'asc')->select('id', 'start_time', 'end_time')->get();

        $is_available = $available_schedules->count() > 0 ? true : false;

        return response()->json(['is_available' => $is_available, 'available_schedules' => $available_schedules]);
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function booking_information(Request $request, $slug)
    {
        $currency = getApiCurrencyCode(true);

        if (!$currency) {
            return response()->json(['message' => __('Currency not found')], 403);
        }

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $service = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            return response()->json(['message' => __('user.Service Not Found')], 403);
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

        $currency_icon = (object) ['icon' => $currency->currency_icon];

        return response()->json([
            'breadcrumb'        => $breadcrumb,
            'service'           => $service,
            'package_features'  => $package_features,
            'benifits'          => $benifits,
            'what_you_will_get' => $what_you_will_get,
            'currency_icon'     => $currency_icon,
        ]);
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payment(Request $request, $slug)
    {
        $currency = getApiCurrencyCode(true);

        if (!$currency) {
            return response()->json(['message' => __('Currency not found')], 403);
        }

        $rules = [
            'extra_service_price' => 'nullable',
        ];

        $this->validate($request, $rules);

        $user = Auth::guard('api')->user();

        if ($user->is_provider == 1) {
            $notification = __('You are log-in as a provider, you can not book any service');
            return response()->json(['message' => $notification], 403);
        }

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            return response()->json(['message' => __('Service Not Found')], 403);
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

        $currency_icon = (object) ['icon' => $currency->currency_icon];

        $total_price = $service->price + $request->get('extra_service_price', 0);

        $total_price = round($total_price, 2);

        return response()->json([
            'breadcrumb'             => $breadcrumb,
            'service'                => $service,
            'package_features'       => $package_features,
            'benifits'               => $benifits,
            'what_you_will_get'      => $what_you_will_get,
            'currency_icon'          => $currency_icon,
            'total_price'            => $total_price,
            'converted_price'        => [
                'icon'        => $currency->currency_icon,
                'position'    => $currency->currency_position,
                'total_price' => $this->generatePrice($total_price),
            ],
            'user'                   => $user,
            'active_payment_methods' => $this->paymentService->getActiveGatewaysWithDetails(),
        ]);
    }

    /**
     * @param $price
     * @param $currency
     */
    private function generatePrice($price)
    {
        $currency = getApiCurrencyCode(true);

        return round($price * $currency->currency_rate, 2);
    }

    /**
     * @param $slug
     */
    public function completeOrder(Request $request, $slug)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            return response()->json(['message' => $notification], 403);
        }

        $rules = [
            'name'               => 'required',
            'email'              => 'nullable|email',
            'phone'              => 'required',
            'address'            => 'required',
            'post_code'          => 'nullable',
            'order_note'         => 'nullable',
            'date'               => 'required',
            'schedule_time_slot' => 'required',
            'payment_method'     => 'required',
        ];

        $customMessages = [
            'name.required'               => __('Name is required'),
            'phone.required'              => __('Phone is required'),
            'address.required'            => __('Address is required'),
            'date.required'               => __('Date is required'),
            'schedule_time_slot.required' => __('Schedule is required'),
            'payment_method.required'     => __('Payment method is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $customer = (object) [
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'post_code'  => $request->post_code,
            'order_note' => $request->order_note,
        ];

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

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

        $extra_price = 0;
        if ($request->ids) {
            foreach ($request->ids as $index => $extra_service) {
                if ($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]) {
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) [
            'ids'        => $request->ids,
            'prices'     => $request->prices,
            'quantities' => $request->quantities,
            'names'      => $request->names,
        ];

        $total_price = $service->price + $extra_price;

        $order_info = (object) [
            'customer'           => $customer,
            'extras'             => $extras,
            'what_you_will_get'  => $what_you_will_get,
            'benifits'           => $benifits,
            'package_features'   => $package_features,
            'extra_price'        => $extra_price,
            'total_price'        => $total_price,
            'package_price'      => $service->price,
            'date'               => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        ];

        $user = Auth::guard('api')->user();

        $provider_id = $service->provider_id;

        $client_id = $user->id;

        $exist = $this->checkAvailabilityBeforePayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            return response()->json(['message' => $notification], 403);
        }

        $order = $this->createOrder($service, $order_info, $provider_id, $client_id, $request->payment_method);

        $provider = $service->provider;

        $this->sendMailToClient($user, $order);

        $this->sendMailToProvider($provider, $order);

        $newToken = JWTAuth::claims(['extra_token' => true])->fromUser($user);

        return response()->json([
            'status'  => 'success',
            'message' => __('Your order has been placed. please wait for admin payment approval'),
            'url'     => route('payment-api.payment', ['token' => $newToken, 'id' => $order->id, 'type' => 'order']),
        ], 200);
    }

    /**
     * @param $slug
     */
    public function check_schedule_during_payment($slug)
    {
        $service    = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $order_info = Session::get('order_info');

        $exist = $this->checkAvailabilityBeforePayment($service, $order_info->date, $order_info->schedule_time_slot);

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
    public function checkAvailabilityBeforePayment($service, $date, $schedule_id)
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
        $extra_services      = $order_info->extras;
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

        // calculate amounts
        $servicePrice             = round($service->price, 2);
        $additionalAmount         = round($additional_amount, 2);
        $couponDiscount           = round($coupon_discount, 2);
        $totalAmount              = (($servicePrice + $additionalAmount) - $couponDiscount);
        $calculateAmount          = $this->calculatePayableCharge($totalAmount, $payment_method);
        $payableAmount            = round($calculateAmount->payable_with_charge, 2);
        $payableAmountWithoutRate = $totalAmount;
        $gatewayCharge            = round($calculateAmount->gateway_charge, 2);
        $payableCurrency          = getApiCurrencyCode();

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

        return $order;
    }

    /**
     * @param $payable_amount
     * @param $gateway_name
     */
    public function calculatePayableCharge($payable_amount, $gateway_name)
    {
        $paymentService = app(PaymentMethodService::class);

        $paymentDetails = $paymentService->getGatewayDetails($gateway_name);

        $currencyId     = $paymentDetails->currency_id ?? '';
        $gateway_charge = $paymentDetails->charge ?? 0;

        if ($paymentService->isSupportsMultiCurrency($gateway_name) && request()->hasHeader('Currency-Code')) {
            $multiCurrencyInfo = $this->getMultiCurrencyInfo();
            $currency_code     = $multiCurrencyInfo['currency_code'];
            $country_code      = $multiCurrencyInfo['country_code'];
            $currency_rate     = $multiCurrencyInfo['currency_rate'];
            $currency_id       = $multiCurrencyInfo['currency_id'];
        } else {
            $currencyDetails = $this->getDefaultCurrencyDetails();
            $currency_code   = $currencyDetails['currency_code'];
            $country_code    = $currencyDetails['country_code'];
            $currency_rate   = $currencyDetails['currency_rate'];
        }

        $payable_amount      = $payable_amount * $currency_rate;
        $gateway_charge      = $payable_amount * ($gateway_charge / 100);
        $payable_with_charge = $payable_amount + $gateway_charge;
        $payable_with_charge = sprintf('%0.2f', $payable_with_charge);

        return (object) [
            'country_code'        => $country_code,
            'currency_code'       => $currency_code,
            'currency_id'         => $currency_id ?? $currencyId,
            'gateway_charge'      => $gateway_charge,
            'payable_with_charge' => $payable_with_charge,
            'payable_amount'      => $payable_amount,
        ];
    }

    private function getMultiCurrencyInfo()
    {
        $gateway_currency = getApiCurrencyCode(true);

        return [
            'currency_code' => $gateway_currency->currency_code,
            'country_code'  => $gateway_currency->country_code,
            'currency_rate' => $gateway_currency->currency_rate,
            'currency_id'   => $gateway_currency->id,
        ];
    }

    /**
     * @param $currencyId
     */
    private function getDefaultCurrencyDetails()
    {
        $gateway_currency = MultiCurrency::where('is_default', 'yes')->first();

        return [
            'currency_code' => $gateway_currency->currency_code,
            'country_code'  => $gateway_currency->country_code,
            'currency_rate' => $gateway_currency->currency_rate,
        ];
    }

    /**
     * @param $id
     */
    public function payForBooking($id)
    {
        $order = Order::find($id);

        if ($order->payment_status == 'success') {
            return response()->json(['message' => __('Payment already completed')], 403);
        }

        $user = Auth::guard('api')->user();

        $extraToken = JWTAuth::claims(['extra_token' => true])->fromUser($user);

        return response()->json([
            'status' => 'success',
            'url'    => route('payment-api.payment', ['token' => $extraToken, 'id' => $order->id, 'type' => 'order']),
        ], 200);
    }

    /**
     * @param $user
     * @param $order
     */
    public function sendMailToClient($user, $order)
    {
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template = EmailTemplate::where('id', 8)->first();
        $subject  = $template->subject;
        $message  = $template->message;
        $message  = str_replace('{{name}}', $user->name, $message);
        $message  = str_replace('{{amount}}', convertToCurrencyAmount($order->total_amount), $message);
        $message  = str_replace('{{schedule_date}}', $order->booking_date, $message);
        $message  = str_replace('{{order_id}}', $order->order_id, $message);

        MailSender::sendMail($user->email, $subject, $message);
    }

    /**
     * @param $provider
     * @param $order
     */
    public function sendMailToProvider($provider, $order)
    {
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template = EmailTemplate::where('id', 9)->first();
        $subject  = $template->subject;
        $message  = $template->message;
        $message  = str_replace('{{name}}', $provider->name, $message);
        $message  = str_replace('{{amount}}', convertToCurrencyAmount($order->total_amount), $message);
        $message  = str_replace('{{schedule_date}}', $order->booking_date, $message);
        $message  = str_replace('{{order_id}}', $order->order_id, $message);

        MailSender::sendMail($provider->email, $subject, $message);
    }
}
