<?php

namespace Modules\Subscription\Http\Controllers\User;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Models\AdditionalService;
use App\Models\EmailTemplate;
use App\Models\Order;
use App\Models\PaypalPayment;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Subscription\Entities\ProviderPaypal;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{

    /**
     * @var mixed
     */
    private $apiContext;

    /**
     * @param $slug
     */
    public function payWithPaypal($slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = __('This Is Demo Version. You Can Not Change Anything');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        // setup config

        $provider_paypal = ProviderPaypal::where('provider_id', $service->provider_id)->first();

        $account          = PaypalPayment::first();
        $paypal_conf      = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $provider_paypal->client_id,
            $provider_paypal->secret_id,
        )
        );

        $setting = [
            'mode'                   => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => true,
            'log.FileName'           => storage_path() . '/logs/paypal.log',
            'log.LogLevel'           => 'ERROR',
        ];
        $this->apiContext->setConfig($setting);

        // setup config

        $user        = Auth::guard('web')->user();
        $order_info  = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id   = $user->id;
        $total_price = $service->price + $order_info->extra_price;

        $paypalSetting = PaypalPayment::first();
        $payableAmount = round($total_price * $paypalSetting->currency_rate, 2);

        $name = env('APP_NAME');

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // set amount total
        $amount = new Amount();
        $amount->setCurrency($paypalSetting->currency_code)
            ->setTotal($payableAmount);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription(env('APP_NAME'));

        // redirect url
        $redirectUrls = new RedirectUrls();

        $root_url = url('/');
        $redirectUrls->setReturnUrl(route('user.sub.paypal-payment-success'))
            ->setCancelUrl(route('user.sub.paypal-payment-cancled'));

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        Session::put('service', $service);

        return redirect($approvalUrl);
    }

    /**
     * @param Request $request
     */
    public function paypalPaymentSuccess(Request $request)
    {

        Session::put('return_from_mollie', 'payment_faild');
        $service = Session::get('service');

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $notification = __('Payment Faild');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('payment', $service->slug)->with($notification);
        }

        // setup config

        $provider_paypal = ProviderPaypal::where('provider_id', $service->provider_id)->first();

        $account          = PaypalPayment::first();
        $paypal_conf      = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $provider_paypal->client_id,
            $provider_paypal->secret_id,
        )
        );

        $setting = [
            'mode'                   => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => true,
            'log.FileName'           => storage_path() . '/logs/paypal.log',
            'log.LogLevel'           => 'ERROR',
        ];
        $this->apiContext->setConfig($setting);

        // setup config

        $payment_id = $request->get('paymentId');
        $payment    = Payment::get($payment_id, $this->apiContext);
        $execution  = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {

            $service     = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user        = Auth::guard('web')->user();
            $order_info  = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id   = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paypal', 'success', $payment_id);

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
    }

    public function paypalPaymentCancled()
    {
        Session::put('return_from_mollie', 'payment_faild');
        $service = Session::get('service');

        $notification = __('Payment Faild');
        $notification = ['message' => $notification, 'alert-type' => 'error'];
        return redirect()->route('payment', $service->slug)->with($notification);
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

        $order                      = new Order();
        $order->order_id            = substr(rand(0, time()), 0, 10);
        $order->booking_date        = $order_info->date;
        $order->client_id           = $client_id;
        $order->provider_id         = $provider_id;
        $order->service_id          = $service->id;
        $order->package_amount      = $service->price;
        $order->additional_amount   = $additional_amount;
        $order->total_amount        = ($service->price + $additional_amount);
        $order->payment_method      = $payment_method;
        $order->transection_id      = $tnx_info;
        $order->payment_status      = $payment_status;
        $order->order_status        = 'awaiting_for_provider_approval';
        $order->package_features    = $service->package_features;
        $order->additional_services = $order_additional_services;
        $order->order_note          = $order_note;
        $order->client_address      = json_encode($client_address);
        $order->save();

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
