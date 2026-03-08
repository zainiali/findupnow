<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use App\Models\CompleteRequest;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ProviderOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('api')->user();
        $orders   = Order::with('client', 'service')->orderBy('id', 'desc')->where('provider_id', $provider->id);

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->get();

        $title = __('All Bookings');

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => [
                'data' => $orders,
            ],
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param Request $request
     */
    public function awaitingBooking(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('api')->user();
        $orders   = Order::with('client', 'service')->orderBy('id', 'desc')->where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id);

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title   = __('Awaiting for approval');
        $setting = Setting::first();

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => $orders,
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param Request $request
     */
    public function activeBooking(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('api')->user();
        $orders   = Order::with('client', 'service')->orderBy('id', 'desc')->where('order_status', 'approved_by_provider')->where('provider_id', $provider->id);

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title   = __('Active Booking');
        $setting = Setting::first();

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => $orders,
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param Request $request
     */
    public function completeBooking(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('api')->user();
        $orders   = Order::with('client', 'service')->orderBy('id', 'desc')->where('order_status', 'complete')->where('provider_id', $provider->id);

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title   = __('Complete Booking');
        $setting = Setting::first();

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => $orders,
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param Request $request
     */
    public function declineBooking(Request $request)
    {
        Paginator::useBootstrap();
        $provider = Auth::guard('api')->user();
        $orders   = Order::with('client', 'service')->orderBy('id', 'desc')->where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client');

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title   = __('Declined Booking');
        $setting = Setting::first();

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => $orders,
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $order = Order::with('client', 'service', 'completeRequest')->where('order_id', $id)->first();
        if (!$order) {
            return response()->json(['message' => __('Booking not found')], 404);
        }
        $setting       = Setting::first();
        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon    = (object) $currency_icon;
        $client           = $order->client;
        $booking_address  = json_decode($order->client_address);
        $package_features = json_decode($order->package_features);

        $additional_services = json_decode($order->additional_services);
        $completeRequest     = $order->completeRequest;

        return response()->json([
            'order'               => $order,
            'currency_icon'       => $currency_icon,
            'client'              => $client,
            'booking_address'     => $booking_address,
            'package_features'    => $package_features,
            'additional_services' => $additional_services,
            'completeRequest'     => $completeRequest,
        ]);
    }

    /**
     * @param $id
     */
    public function bookingDecilendRequest($id)
    {
        $order               = Order::find($id);
        $order->order_status = 'order_decliened_by_provider';
        $order->save();

        $notification = __('Declined Successfully');
        return response()->json(['message' => $notification]);
    }

    /**
     * @param $id
     */
    public function bookingApprovedRequest($id)
    {
        $order               = Order::find($id);
        $order->order_status = 'approved_by_provider';
        $order->save();

        $notification = __('Approved Successfully');
        return response()->json(['message' => $notification]);
    }

    /**
     * @param Request $request
     */
    public function completeRequest(Request $request)
    {

        Paginator::useBootstrap();

        $provider         = Auth::guard('api')->user();
        $completeRequests = CompleteRequest::where('provider_id', $provider->id)->get();
        $order_id_array   = [];

        foreach ($completeRequests as $completeRequest) {
            $order_id_array[] = $completeRequest->order_id;
        }

        $orders = Order::with('client', 'service')->whereIn('id', $order_id_array)->orderBy('id', 'desc')->where('provider_id', $provider->id)->where('order_status', '!=', 'complete');

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title   = __('Complete Request');
        $setting = Setting::first();

        $currency_icon = [
            'icon' => getApiCurrencyIcon(),
        ];
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status', 'awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status', 'approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status', 'complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status', 'order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'title'             => $title,
            'orders'            => $orders,
            'currency_icon'     => $currency_icon,
            'decliened_booking' => $decliened_booking,
            'total_awaiting'    => $total_awaiting,
            'active_booking'    => $active_booking,
            'complete_booking'  => $complete_booking,
        ]);
    }

    /**
     * @param Request $request
     */
    public function sendCompleteRequest(Request $request)
    {
        $user  = Auth::guard('api')->user();
        $rules = [
            'resone'   => 'required',
            'order_id' => 'required',
        ];
        $customMessages = [
            'resone.required'   => __('Resone is required'),
            'order_id.required' => __('Order id is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $data              = new CompleteRequest();
        $data->provider_id = $user->id;
        $data->order_id    = $request->order_id;
        $data->resone      = $request->resone;
        $data->save();

        $notification = __('Request Send Successfully');
        return response()->json(['message' => $notification]);

    }

}
