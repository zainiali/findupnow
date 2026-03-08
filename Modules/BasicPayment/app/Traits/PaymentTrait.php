<?php

namespace Modules\BasicPayment\app\Traits;

use App\Facades\MailSender;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\Subscription\Entities\PurchaseHistory;

trait PaymentTrait
{
    /**
     * @var string
     */
    private $appName = 'AabcServe';

    protected static array $messages = [
        'success'             => 'Payment completed successfully',
        'failed'              => 'Payment failed, please try again',
        'pending'             => 'Payment pending, wait for payment confirmation',
        'paymentTypeNotFound' => 'Payment Type Not Found!',
        'error'               => 'An error occurred. Please try again.',
    ];

    /**
     * @param $order
     */
    protected function checkUnpaidStatus($order)
    {
        $errorMessage = 'Payment already completed or rejected!';

        if ($order->payment_status !== 'pending') {
            session()->flash('message', __($errorMessage));
            session()->flash('alert-type', 'error');

            throw new HttpResponseException(
                redirect()
                    ->back()
                    ->with(['message' => __($errorMessage), 'alert-type' => 'error']),
            );
        }
    }

    /**
     * @return mixed
     */
    protected function saveOrderSuccess($order, $details, $amount, $currency, $trxId, $orderType = 'order')
    {
        if ($orderType == 'order') {
            $order->payment_details = json_encode($details);
            $order->paid_amount     = $amount;
            $order->transection_id  = $trxId;
            $order->payment_status  = 'success';
            $return                 = $order->save();

            if ($return) {
                $subject = 'Payment Success';
                $user    = $order->client;
                $message = "Your order payment has been successfully completed with transaction ID: {$trxId} for {$order->payment_method}.";

                MailSender::sendMail($user->email, $subject, $message);
            }

        } elseif ($orderType == 'subscription') {
            $order->status          = 'active';
            $order->payment_status  = 'success';
            $order->transaction     = $trxId;
            $order->payment_details = json_encode($details);
            $order->paid_amount     = $amount;
            $return                 = $order->save();

            if ($return) {
                PurchaseHistory::where('provider_id', $order->provider_id)
                    ->whereNotIn('id', [$order->id])
                    ->update(['status' => 'expired']);

                $subject = 'Payment Success';
                $user    = $order->provider;
                $message = "Your subscription payment has been successfully completed with transaction ID: {$trxId} for {$order->payment_method}. Your subscription is now active.";

                MailSender::sendMail($user->email, $subject, $message);
            }
        } else {
            return false;
        }

        return $return;
    }

    public function afterSuccessOperations(): void
    {
        PaymentMethodService::removeSessions();
    }

    /**
     * @param $value
     */
    private function checkArrayIsset($value)
    {
        return isset($value) ? $value : null;
    }

    /**
     * @param $type
     * @param $order
     */
    private function putProviderSession($type, $order): void
    {
        $type == 'order' ? session()->put('order_provider_id', $order?->provider_id) : session()->forget('order_provider_id');
    }
}
