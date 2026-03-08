<?php

namespace App\Http\Controllers\Admin;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\City;
use App\Models\CompleteRequest;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\MessageDocument;
use App\Models\Order;
use App\Models\ProviderClientReport;
use App\Models\ProviderWithdraw;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $providers = User::where('is_provider', 1)->orderBy('id', 'desc')->where('status', 1)->get();

        return view('admin.provider.provider', compact('providers'));
    }

    public function pendingProvider()
    {
        $providers = User::where('is_provider', 1)->where('status', 0)->orderBy('id', 'desc')->get();

        return view('admin.provider.provider', compact('providers'));
    }

    public function sendEmailToAllProvider()
    {
        return view('admin.provider.send_email_to_all_provider');
    }

    /**
     * @param Request $request
     */
    public function sendMailToAllProvider(Request $request)
    {
        $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'subject.required' => __('Subject is required'),
            'message.required' => __('Message is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $providers = User::where('is_provider', 1)->orderBy('id', 'desc')->get();

        MailHelper::setMailConfig();

        foreach ($providers as $provider) {
            MailSender::sendMail($provider->email, $request->subject, $request->message);
        }

        $notification = __('Email Send Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function sendEmailToProvider($id)
    {
        $user = User::find($id);
        return view('admin.provider.send_provider_email', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function sendMailtoSingleProvider(Request $request, $id)
    {
        $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'subject.required' => __('Subject is required'),
            'message.required' => __('Message is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::find($id);

        MailHelper::setMailConfig();

        MailSender::sendMail($user->email, $request->subject, $request->message);

        $notification = __('Email Send Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $provider = User::where('id', $id)->first();
        $setting  = Setting::first();

        $default_avatar = [
            'image' => $setting->default_avatar,
        ];
        $default_avatar = (object) $default_avatar;

        $countries = Country::orderBy('name', 'asc')->where('status', 1)->get();
        $states    = CountryState::orderBy('name', 'asc')->where(['status' => 1, 'country_id' => $provider->country_id])->get();
        $cities    = City::orderBy('name', 'asc')->where(['status' => 1, 'country_state_id' => $provider->state_id])->get();

        $orders             = Order::where('provider_id', $provider->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = ProviderWithdraw::where('user_id', $provider->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services      = Service::where('provider_id', $provider->id)->get();
        $total_service = $services->count();

        return view('admin.provider.show_provider', compact('provider', 'setting', 'countries', 'states', 'cities', 'default_avatar', 'total_sold_service', 'total_withdraw', 'total_service', 'current_balance', 'total_balance'));

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function updateProvider(Request $request, $id)
    {
        $provider = User::find($id);
        $rules    = [
            'name'        => 'required',
            'email'       => 'required|unique:users,email,' . $provider->id,
            'phone'       => 'required',
            'country'     => 'required',
            'state'       => 'required',
            'designation' => 'required',
            'address'     => 'required',
            'image'       => 'nullable|mimetypes:image/jpeg,image/pjpeg,image/png,image/gif,image/svg+xml,image/webp,image/avif,image/bmp,image/x-icon,image/vnd.microsoft.icon|max:2048',
        ];
        $customMessages = [
            'name.required'        => __('Name is required'),
            'email.required'       => __('Email is required'),
            'email.unique'         => __('Email already exist'),
            'phone.required'       => __('Phone is required'),
            'country.required'     => __('Country or region is required'),
            'state.required'       => __('State or province is required'),
            'city.required'        => __('Service area is required'),
            'designation.required' => __('Desgination is required'),
            'address.required'     => __('Address is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $provider->name        = $request->name;
        $provider->phone       = $request->phone;
        $provider->country_id  = $request->country;
        $provider->state_id    = $request->state;
        $provider->city_id     = $request->city;
        $provider->designation = $request->designation;
        $provider->address     = $request->address;

        // Handle image upload
        if ($request->hasFile('image')) {
            $provider->image = saveFileGetPath($request->image, oldFile: $provider->image);
        }

        $provider->save();

        $notification = __('Update Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $user       = User::find($id);
        $user_image = $user->image;

        if ($user_image) {
            if (File::exists(public_path() . '/' . $user_image)) {
                unlink(public_path() . '/' . $user_image);
            }

        }

        AppointmentSchedule::where('user_id', $id)->delete();
        Review::where('provider_id', $id)->delete();
        $orders = Order::where('provider_id', $id)->get();
        foreach ($orders as $order) {
            CompleteRequest::where('order_id', $order->id)->delete();
            ProviderClientReport::where('order_id', $order->id)->delete();
            RefundRequest::where('order_id', $id)->delete();
            $tickets = Ticket::where('order_id', $order->id)->get();

            foreach ($tickets as $ticket) {
                $messages = TicketMessage::where('ticket_id', $ticket->id)->delete();
                foreach ($messages as $message) {
                    $doucments = MessageDocument::where('ticket_message_id', $message->id)->get();
                    foreach ($doucments as $doucment) {
                        $document_file = $doucment->file_name;
                        if ($document_file) {
                            if (File::exists(public_path() . '/' . $document_file)) {
                                unlink(public_path() . '/' . $document_file);
                            }

                        }
                        $doucment->delete();
                    }
                    $message->delete();
                }
                $ticket->delete();
            }
            $order->delete();
        }

        $services = Service::where('provider_id', $user->id)->get();

        foreach ($services as $service) {
            $additionals = AdditionalService::where('service_id', $service->id)->get();
            foreach ($additionals as $additional) {
                $additional_image = $additional->image;
                if ($additional_image) {
                    if (File::exists(public_path() . '/' . $additional_image)) {
                        unlink(public_path() . '/' . $additional_image);
                    }

                }
                $additional->delete();
            }
            $service_image = $service->image;
            if ($service_image) {
                if (File::exists(public_path() . '/' . $service_image)) {
                    unlink(public_path() . '/' . $service_image);
                }

            }
            $service->delete();
        }

        $user->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $provider = User::find($id);
        if ($provider->status == 1) {
            $provider->status = 0;
            $provider->save();

            Service::where('provider_id', $id)->update(['approve_by_admin' => 0]);

            $message = __('Inactive Successfully');
        } else {
            $provider->status = 1;
            $provider->save();

            Service::where('provider_id', $id)->update(['approve_by_admin' => 1]);

            $message = __('Active Successfully');
        }
        return response()->json($message);

    }

}
