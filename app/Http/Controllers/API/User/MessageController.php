<?php

namespace App\Http\Controllers\API\User;

use App\Events\BuyerProviderMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $provider = Auth::guard('api')->user();

        $buyers = Message::with('provider')->where(['buyer_id' => $provider->id])->select('provider_id')->groupBy('provider_id')->orderBy('id', 'desc')->get();

        $setting = Cache::get('setting');

        return response()->json([
            'buyers'         => $buyers,
            'default_avatar' => $setting->default_avatar,
        ]);
    }

    /**
     * @param $id
     */
    public function load_chat_box($id)
    {
        $buyer = Auth::guard('api')->user();

        $provider = User::find($id);

        $messages = Message::with('service')->where(['buyer_id' => $buyer->id, 'provider_id' => $id])->get();

        Message::where(['buyer_id' => $buyer->id, 'provider_id' => $id])->update(['buyer_read_msg' => 1]);

        return response()->json([
            'messages' => $messages,
            'buyer'    => $buyer,
            'provider' => $provider,
        ]);
    }

    /**
     * @param Request $request
     */
    public function send_message_to_provider(Request $request)
    {

        $request->validate([
            'provider_id' => 'required',
            'message'     => 'required',
        ]);

        $buyer = Auth::guard('api')->user();

        $message                    = new Message();
        $message->provider_id       = $request->provider_id;
        $message->buyer_id          = $buyer->id;
        $message->message           = $request->message;
        $message->provider_read_msg = 0;
        $message->buyer_read_msg    = 1;
        $message->send_by           = 'buyer';
        $message->service_id        = $request->service_id ? $request->service_id : 0;
        $message->save();

        $provider = User::find($request->provider_id);

        $messages = Message::with('service')->where(['provider_id' => $provider->id, 'buyer_id' => $buyer->id])->get();

        $data = [[
            'buyer_id'   => $buyer->id,
            'message_id' => $message->id,
            'message'    => $request->message,
        ]];

        event(new BuyerProviderMessage($data, $provider));

        return response()->json([
            'messages' => $messages,
            'buyer'    => $buyer,
            'provider' => $provider,
        ]);

    }
}
