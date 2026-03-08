<?php

namespace App\Http\Controllers\User;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\BankPayment;
use App\Models\BreadcrumbImage;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\EmailTemplate;
use App\Models\Flutterwave;
use App\Models\InstamojoPayment;
use App\Models\Order;
use App\Models\PaypalPayment;
use App\Models\PaystackAndMollie;
use App\Models\RazorpayPayment;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Setting;
use App\Models\StripePayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mollie\Laravel\Facades\Mollie;
use Razorpay\Api\Api;
use Stripe;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * @param Request $request
     */
    public function apply_coupon(Request $request)
    {

        $coupon = Coupon::where(['coupon_code' => $request->coupon, 'status' => 1])->first();

        if (!$coupon) {
            $notification = __('Invalid coupon');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        if ($coupon->expired_date < date('Y-m-d')) {
            $notification = __('Coupon already expired');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        if ($coupon->provider_id != 0) {
            if ($coupon->provider_id != $request->provider_id) {
                $notification = __('You can not apply another provider coupon');
                $notification = ['message' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        }

        Session::put('coupon_code', $coupon->coupon_code);
        Session::put('offer_percentage', $coupon->offer_percentage);

        $notification = __('Coupon applied successful');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);

    }

    /**
     * @param Request $request
     */
    public function removeCoupon()
    {
        Session::forget('coupon_code');
        Session::forget('offer_percentage');

        $notification = __('Coupon removed successful');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $slug
     */
    public function ready_to_booking(Request $request, $slug)
    {
        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();

        $what_you_will_get = [];
        $benifits = [];
        $package_features = [];
        $additional_services = collect([]);

        if ($slug == 'custom-request') {
            $service = new Service(); // Create a dummy service object
            $service->name = $request->get('query', 'Custom Project'); // Use query param for title
            $service->seo_title = 'Get Quotes';
            $service->seo_description = 'Get quotes for your project';
            $service->slug = 'custom-request';
            $service->image = ''; // Or a default image
            $service->price = 0;
            $service->id = 0; // Dummy ID
            // Create a dummy category object to prevent errors
            $service->category = (object) [
                'slug' => $request->get('category', ''),
                'name' => $request->get('query', 'Custom Project')
            ];
            $service->provider = null; // No provider for custom requests
            // You might need other required fields depending on view usage, but checking view, it seems safe.
        } else {
            $service = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            if (!$service) {
                // Check if it might be a category slug before aborting?
                // The user said "if clicks on categories then take to services". This is handled on homepage.
                // But if they type "Plumbing" and it's not a service but a category?
                // Homepage JS handles category selection. This controller is for "ready to book".
                // So if we are here, it's either a valid service or we treat it as custom if logic allows.
                // For now, stick to 'custom-request' logic or 404.
                abort(404);
            }

            if ($service->what_you_will_provide) {
                $provides = json_decode($service->what_you_will_provide);
                foreach ($provides as $provide) {
                    $what_you_will_get[] = $provide;
                }
            }

            if ($service->benifit) {
                $exist_benifits = json_decode($service->benifit);
                foreach ($exist_benifits as $exist_benifit) {
                    $benifits[] = $exist_benifit;
                }
            }

            if ($service->package_features) {
                $features = json_decode($service->package_features);
                foreach ($features as $feature) {
                    $package_features[] = $feature;
                }
            }

            $additional_services = AdditionalService::where('service_id', $service->id)->get();
        }

        $setting       = Setting::first();
        $currency_icon = (object) ['icon' => $setting->currency_icon];

        return view('website.ready_to_booking')->with([
            'active_theme'        => getActiveThemeLayout(),
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
        $day                   = date('l', strtotime($request->date));
        $appointment_schedules = AppointmentSchedule::where(['user_id' => $request->provider_id, 'day' => $day])->where('status', 1)->get();

        $available_schedule_arr = [];
        foreach ($appointment_schedules as $appointment_schedule) {
            $exist = Order::where(['provider_id' => $request->provider_id, 'appointment_schedule_id' => $appointment_schedule->id, 'booking_date' => $request->date])->count();
            if ($exist == 0) {
                $available_schedule_arr[] = $appointment_schedule->id;
            }
        }

        $available_schedules = AppointmentSchedule::whereIn('id', $available_schedule_arr)->where('status', 1)->orderBy('start_time', 'asc')->get();

        $is_available = $available_schedules->count() > 0 ? true : false;
        $html         = "<option value=''>" . __('Select') . "</option>";
        foreach ($available_schedules as $index => $schedule) {
            $html .= '<option value="' . $schedule->id . '">' . strtoupper(date('h:i A', strtotime($schedule->start_time))) . ' - ' . strtoupper(date('h:i A', strtotime($schedule->end_time))) . '</option>';
        }

        return response()->json(['is_available' => $is_available, 'available_schedules' => $html]);
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function booking_information(Request $request, $slug)
    {
        $extras = (object) [
            'ids'                => $request->ids,
            'prices'             => $request->prices,
            'quantities'         => $request->quantities,
            'names'              => $request->names,
            'extra_total'        => $request->extra_total,
            'sub_total'          => $request->sub_total,
            'total'              => $request->total,
            'date'               => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        ];

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $service = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if (!$service) {
            abort(404);
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

        return view('website.booking_information')->with([
            'active_theme'      => getActiveThemeLayout(),
            'breadcrumb'        => $breadcrumb,
            'service'           => $service,
            'package_features'  => $package_features,
            'benifits'          => $benifits,
            'what_you_will_get' => $what_you_will_get,
            'extra_services'    => $extras,
            'extras'            => json_encode($extras),
            'currency_icon'     => $currency_icon,
        ]);
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

        if (Session::has('return_from_mollie')) {
            $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
            $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            if (!$service) {
                abort(404);
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

            $order_info = Session::get('order_info');
            $customer   = $order_info->customer;

            $extras         = $order_info->extras;
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

            $user             = Auth::guard('web')->user();
            $bankPayment      = BankPayment::select('id', 'status', 'account_info', 'image')->first();
            $stripe           = StripePayment::first();
            $paypal           = PaypalPayment::first();
            $razorpay         = RazorpayPayment::first();
            $flutterwave      = Flutterwave::first();
            $mollie           = PaystackAndMollie::first();
            $paystack         = $mollie;
            $instamojoPayment = InstamojoPayment::first();

            return view('website.payment')->with([
                'active_theme'      => getActiveThemeLayout(),
                'breadcrumb'        => $breadcrumb,
                'service'           => $service,
                'customer'          => $customer,
                'package_features'  => $package_features,
                'benifits'          => $benifits,
                'what_you_will_get' => $what_you_will_get,
                'extra_services'    => $extra_services,
                'currency_icon'     => $currency_icon,
                'bankPayment'       => $bankPayment,
                'stripe'            => $stripe,
                'paypal'            => $paypal,
                'razorpay'          => $razorpay,
                'total_price'       => $total_price,
                'flutterwave'       => $flutterwave,
                'user'              => $user,
                'mollie'            => $mollie,
                'instamojoPayment'  => $instamojoPayment,
                'paystack'          => $paystack,
            ]);
        } else {
            $rules = [
                'name'       => 'required',
                'phone'      => 'required',
                'address'    => 'required',
                'agree_with' => 'required',
            ];
            $customMessages = [
                'name.required'       => __('Name is required'),
                'email.required'      => __('Email is required'),
                'phone.required'      => __('Phone is required'),
                'address.required'    => __('Address is required'),
                'agree_with.required' => __('Agree with terms and conditions is required'),
            ];
            $this->validate($request, $rules, $customMessages);

            $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
            $service    = Service::with('category', 'provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            if (!$service) {
                abort(404);
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

            $user             = Auth::guard('web')->user();
            $bankPayment      = BankPayment::select('id', 'status', 'account_info', 'image')->first();
            $stripe           = StripePayment::first();
            $paypal           = PaypalPayment::first();
            $razorpay         = RazorpayPayment::first();
            $flutterwave      = Flutterwave::first();
            $mollie           = PaystackAndMollie::first();
            $paystack         = $mollie;
            $instamojoPayment = InstamojoPayment::first();

            return view('website.payment')->with([
                'active_theme'      => getActiveThemeLayout(),
                'breadcrumb'        => $breadcrumb,
                'service'           => $service,
                'customer'          => $customer,
                'package_features'  => $package_features,
                'benifits'          => $benifits,
                'what_you_will_get' => $what_you_will_get,
                'extra_services'    => $extra_services,
                'currency_icon'     => $currency_icon,
                'bankPayment'       => $bankPayment,
                'stripe'            => $stripe,
                'paypal'            => $paypal,
                'razorpay'          => $razorpay,
                'total_price'       => $total_price,
                'flutterwave'       => $flutterwave,
                'user'              => $user,
                'mollie'            => $mollie,
                'paystack'          => $paystack,
                'instamojoPayment'  => $instamojoPayment,
            ]);
        }

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
     * @param Request $request
     * @param $slug
     */
    public function bankPayment(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $rules = [
            'tnx_info' => 'required',
        ];
        $customMessages = [
            'tnx_info.required' => __('Transaction is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $user        = Auth::guard('web')->user();
        $order_info  = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id   = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Bank', 'pending', $request->tnx_info);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = __('Your order has been placed. please wait for admin payment approval');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithStripe(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $service     = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user        = Auth::guard('web')->user();
        $order_info  = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id   = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $total_price = $service->price + $order_info->extra_price;

        $coupon_discount = 0.00;
        if (Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount  = ($offer_percentage / 100) * $total_price;
        }

        $stripe        = StripePayment::first();
        $payableAmount = round(($total_price - $coupon_discount) * $stripe->currency_rate, 2);
        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        $result = Stripe\Charge::create([
            "amount"      => $payableAmount * 100,
            "currency"    => $stripe->currency_code,
            "source"      => $request->stripeToken,
            "description" => env('APP_NAME'),
        ]);

        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Stripe', 'success', $result->balance_transaction);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = __('Your order has been placed. Thanks for your new order');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('dashboard')->with($notification);

    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithRazorpay(Request $request, $slug)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $razorpay = RazorpayPayment::first();
        $input    = $request->all();
        $api      = new Api($razorpay->key, $razorpay->secret_key);
        $payment  = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(['amount' => $payment['amount']]);
                $payId    = $response->id;

                $service     = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user        = Auth::guard('web')->user();
                $order_info  = Session::get('order_info');
                $provider_id = $service->provider_id;
                $client_id   = $user->id;

                $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

                if ($exist > 0) {
                    $notification = __('This schedule already booked. please choose another schedule');
                    $notification = ['message' => $notification, 'alert-type' => 'error'];
                    return redirect()->route('ready-to-booking', $service->slug)->with($notification);
                }

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Razorpay', 'success', $payId);

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');

                $notification = __('Your order has been placed. Thanks for your new order');
                $notification = ['message' => $notification, 'alert-type' => 'success'];
                return redirect()->route('dashboard')->with($notification);

            } catch (Exception $e) {
                $notification = __('Payment Faild');
                $notification = ['message' => $notification, 'alert-type' => 'error'];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithFlutterwave(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $flutterwave = Flutterwave::first();
        $curl        = curl_init();
        $tnx_id      = $request->tnx_id;
        $url         = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token       = $flutterwave->secret_key;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "Content-Type: application/json",
                "Authorization: Bearer $token",
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if ($response->status == 'success') {
            $service     = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user        = Auth::guard('web')->user();
            $order_info  = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id   = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Flutterwave', 'success', $tnx_id);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            $notification = __('Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success', 'message' => $notification]);
        } else {
            $notification = __('Payment Faild');
            return response()->json(['status' => 'faild', 'message' => $notification]);
        }
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithMollie(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $service     = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user        = Auth::guard('web')->user();
        $order_info  = Session::get('order_info');
        $total_price = $service->price + $order_info->extra_price;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $coupon_discount = 0.00;
        if (Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount  = ($offer_percentage / 100) * $total_price;
        }

        $mollie = PaystackAndMollie::first();
        $price  = ($total_price - $coupon_discount) * $mollie->mollie_currency_rate;
        $price  = round($price, 2);
        $price  = sprintf('%0.2f', $price);

        $mollie_api_key = $mollie->mollie_key;
        $currency       = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount'      => [
                'currency' => $currency,
                'value'    => '' . $price . '',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id', $payment->id);
        session()->put('service', $service);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * @param Request $request
     */
    public function molliePaymentSuccess(Request $request)
    {

        $service = Session::get('service');
        Session::put('return_from_mollie', 'payment_faild');
        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $mollie         = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()) {
            $service     = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user        = Auth::guard('web')->user();
            $order_info  = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id   = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Mollie', 'success', session()->get('payment_id'));

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');
            Session::forget('return_from_mollie');

            $notification = __('Your order has been placed. Thanks for your new order');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('payment', $service->slug)->with($notification);
        }
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithPayStack(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $paystack = PaystackAndMollie::first();

        $reference   = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key  = $paystack->paystack_secret_key;
        $curl        = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ],
        ]);
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if ($final_data->status == true) {

            $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            $user        = Auth::guard('web')->user();
            $order_info  = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id   = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paystack', 'success', $transaction);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            $notification = __('Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success', 'message' => $notification]);
        } else {
            $notification = __('Payment Faild');
            return response()->json(['status' => 'faild', 'message' => $notification]);
        }
    }

    /**
     * @param Request $request
     * @param $slug
     */
    public function payWithInstamojo(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $service     = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user        = Auth::guard('web')->user();
        $order_info  = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id   = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $total_price = $service->price + $order_info->extra_price;

        $coupon_discount = 0.00;
        if (Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount  = ($offer_percentage / 100) * $total_price;
        }

        $instamojoPayment = InstamojoPayment::first();
        $price            = ($total_price - $coupon_discount) * $instamojoPayment->currency_rate;
        $price            = round($price, 2);

        $environment = $instamojoPayment->account_mode;
        $api_key     = $instamojoPayment->api_key;
        $auth_token  = $instamojoPayment->auth_token;

        if ($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url . 'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            ["X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"]);
        $payload = [
            'purpose'                 => env("APP_NAME"),
            'amount'                  => $price,
            'phone'                   => '918160651749',
            'buyer_name'              => Auth::user()->name,
            'redirect_url'            => route('response-instamojo'),
            'send_email'              => true,
            'webhook'                 => 'http://www.example.com/webhook/',
            'send_sms'                => true,
            'email'                   => Auth::user()->email,
            'allow_repeated_payments' => false,
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        Session::put('service', $service);
        return redirect($response->payment_request->longurl);
    }

    /**
     * @param Request $request
     */
    public function instamojoResponse(Request $request)
    {

        Session::put('return_from_mollie', 'payment_faild');
        $service = Session::get('service');

        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if ($exist > 0) {
            $notification = __('This schedule already booked. please choose another schedule');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $input            = $request->all();
        $instamojoPayment = InstamojoPayment::first();
        $environment      = $instamojoPayment->account_mode;
        $api_key          = $instamojoPayment->api_key;
        $auth_token       = $instamojoPayment->auth_token;

        if ($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . 'payments/' . $request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            ["X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"]);
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('payment', $service->slug)->with($notification);
        } else {
            $data = json_decode($response);
        }

        if ($data->success == true) {
            if ($data->payment->status == 'Credit') {

                $service     = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user        = Auth::guard('web')->user();
                $order_info  = Session::get('order_info');
                $provider_id = $service->provider_id;
                $client_id   = $user->id;

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');
                Session::forget('return_from_mollie');
                Session::forget('service');

                $notification = __('Your order has been placed. Thanks for your new order');
                $notification = ['message' => $notification, 'alert-type' => 'success'];
                return redirect()->route('dashboard')->with($notification);
            }
        } else {
            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('payment', $service->slug)->with($notification);
        }
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
    public function createOrder($user, $service, $order_info, $provider_id, $client_id, $payment_method, $payment_status, $tnx_info)
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

        $order                          = new Order();
        $order->order_id                = substr(rand(0, time()), 0, 10);
        $order->booking_date            = $order_info->date;
        $order->appointment_schedule_id = $order_info->schedule_time_slot;
        $order->schedule_time_slot      = $time_slot;
        $order->client_id               = $client_id;
        $order->provider_id             = $provider_id;
        $order->service_id              = $service->id;
        $order->package_amount          = $service->price;
        $order->additional_amount       = $additional_amount;
        $order->coupon_discount         = $coupon_discount;
        $order->total_amount            = (($service->price + $additional_amount) - $coupon_discount);
        $order->payment_method          = $payment_method;
        $order->transection_id          = $tnx_info;
        $order->payment_status          = $payment_status;
        $order->order_status            = 'awaiting_for_provider_approval';
        $order->package_features        = $service->package_features;
        $order->additional_services     = $order_additional_services;
        $order->order_note              = $order_note;
        $order->client_address          = json_encode($client_address);
        $order->save();

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
        $message  = str_replace('{{amount}}', $setting->currency_icon . $order->total_amount, $message);
        $message  = str_replace('{{schedule_date}}', $order->booking_date, $message);
        $message  = str_replace('{{order_id}}', $order->order_id, $message);

        MailSender::sendMail($provider->email, $subject, $message);
    }
}
