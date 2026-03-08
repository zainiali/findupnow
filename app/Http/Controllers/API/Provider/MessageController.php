<?php

namespace App\Http\Controllers\API\Provider;

use App\Events\BuyerProviderMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $provider = Auth::guard('api')->user();

        $buyers = Message::with('buyer')->where(['provider_id' => $provider->id])->select('buyer_id')->groupBy('buyer_id')->orderBy('id', 'desc')->get();

        $setting        = Setting::first();
        $default_avatar = (object) [
            'image' => $setting->default_avatar,
        ];

        return response()->json([
            'buyers'         => $buyers,
            'default_avatar' => $default_avatar,
            'provider'       => $provider,
        ]);

    }

    /**
     * @param $id
     */
    public function load_chat_box($id)
    {
        $provider = Auth::guard('api')->user();

        $setting        = Setting::first();
        $default_avatar = (object) [
            'image' => $setting->default_avatar,
        ];
        $buyer = User::find($id);

        $messages = Message::where(['provider_id' => $provider->id, 'buyer_id' => $id])->get();

        Message::where(['provider_id' => $provider->id, 'buyer_id' => $id])->update(['provider_read_msg' => 1]);

        return response()->json([
            'messages'       => $messages,
            'provider'       => $provider,
            'default_avatar' => $default_avatar,
            'buyer'          => $buyer,
        ]);

    }

    /**
     * @param Request $request
     */
    public function send_message_to_buyer(Request $request)
    {

        $request->validate([
            'buyer_id' => 'required',
            'message'  => 'required',
        ]);

        $provider = Auth::guard('api')->user();

        $message                    = new Message();
        $message->buyer_id          = $request->buyer_id;
        $message->provider_id       = $provider->id;
        $message->message           = $request->message;
        $message->provider_read_msg = 1;
        $message->buyer_read_msg    = 0;
        $message->send_by           = 'provider';
        $message->save();

        $setting        = Setting::first();
        $default_avatar = (object) [
            'image' => $setting->default_avatar,
        ];
        $buyer = User::find($request->buyer_id);

        $messages = Message::where(['provider_id' => $provider->id, 'buyer_id' => $request->buyer_id])->get();

        $data = [[
            'provider_id' => $provider->id,
            'message_id'  => $message->id,
            'message'     => $message->message,
        ]];

        event(new BuyerProviderMessage($data, $buyer));

        return response()->json([
            'messages'       => $messages,
            'provider'       => $provider,
            'default_avatar' => $default_avatar,
            'buyer'          => $buyer,
        ]);
    }

    /**
     * @param $id
     */
    public function find_new_buyer($id)
    {
        $buyer = User::select('id', 'name', 'image')->find($id);

        $setting        = Setting::first();
        $default_avatar = (object) [
            'image' => $setting->default_avatar,
        ];

        return response()->json([
            'buyer'          => $buyer,
            'default_avatar' => $default_avatar,
        ]);

    }
}
