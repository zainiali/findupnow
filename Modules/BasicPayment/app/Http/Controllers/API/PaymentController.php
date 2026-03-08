<?php

namespace Modules\BasicPayment\app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BreadcrumbImage;
use App\Models\Order;
use App\Traits\GetGlobalInformationTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\BasicPayment\app\Services\PaymentMethodService;
use Modules\GlobalSetting\app\Models\Setting as SettingModel;
use Modules\Subscription\Entities\PurchaseHistory;

class PaymentController extends Controller
{
    use GetGlobalInformationTrait;

    /**
     * @var mixed
     */
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = app(\Modules\BasicPayment\app\Services\PaymentMethodService::class);
    }

    /**
     * @return mixed
     */
    public function getActiveMethods(): JsonResponse
    {
        $data = $this->paymentService->getActiveGatewaysWithDetails();

        return $data ? response()->json(['status' => 'success', 'data' => $data], 200) : response()->json(['status' => 'error', 'message' => 'Not Found!'], 404);
    }

    /**
     * @param Request $request
     */
    public function payment(Request $request, $id, $token, $type = 'order')
    {
        $request->headers->set('Authorization', 'Bearer ' . $token);

        $data['user'] = auth('api')->user();

        if (!$data['user']) {
            abort(401);
        }

        $data['token'] = $token;

        $data['purchase'] = $this->getPurchaseData($type, $id);

        $data['amount'] = $type == 'order' ? $data['purchase']->payable_amount : $data['purchase']->payable_amount;

        $data['currencyCode'] = $data['purchase']->payable_currency;

        $this->checkUnpaidStatus($data['purchase']);

        if (!$this->paymentService->isActive($data['purchase']->payment_method)) {
            return response()->json(['status' => 'error', 'message' => 'The selected payment method is now inactive.'], 400);
        }

        $data['type']            = $type;
        $data['orderId']         = $data['purchase']->id;
        $data['paymentViewPath'] = app(PaymentMethodService::class)->getBladeView($data['purchase']->payment_method);
        $data['breadcrumb']      = BreadcrumbImage::where(['id' => 8])->first();

        if (SettingModel::where('key', 'commission_type')->first()->value !== 'commission' && $type == 'order' && $data['purchase']->provider_id) {
            Session::put('order_provider_id', $data['purchase']->provider_id);
        }

        $data['active_theme'] = getActiveThemeLayout();

        return view('subscription::complete-payment', $data);
    }

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
     * @param  $type
     * @param  $id
     * @return mixed
     */
    private function getPurchaseData($type, $id)
    {
        return $type == 'order' ? Order::findOrFail($id) : PurchaseHistory::findOrFail($id);
    }

    public function payment_success()
    {
        $image     = 'success.webp';
        $title     = 'Your order has been placed';
        $sub_title = __('For check more details you can go to your dashboard');

        return view('basicpayment::app_order_notification', compact('image', 'title', 'sub_title'));
    }

    public function payment_failed()
    {
        $image     = 'fail.webp';
        $title     = 'Your order has been fail';
        $sub_title = __('Please try again for more details connect with us');
        return view('basicpayment::app_order_notification', compact('image', 'title', 'sub_title'));
    }
}
