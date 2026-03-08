<?php

namespace App\Http\Controllers\Admin;

use App\Facades\MailSender;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\CompleteRequest;
use App\Models\Message;
use App\Models\MessageDocument;
use App\Models\Order;
use App\Models\ProviderClientReport;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobRequest;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $customers = User::orderBy('id', 'desc')->where('status', 1)->get();

        return view('admin.customer.customer', compact('customers'));
    }

    public function pendingCustomerList()
    {
        $customers = User::orderBy('id', 'desc')->where('status', 0)->get();
        return view('admin.customer.customer', compact('customers'));
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $customer = User::find($id);
        if ($customer) {
            return view('admin.customer.show_customer', compact('customer'));
        } else {
            $notification = 'Something went wrong';
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('admin.customer-list')->with($notification);
        }

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user       = User::find($id);
            $user_image = $user->image;
            $user->delete();
            if ($user_image) {
                if (File::exists(public_path() . '/' . $user_image)) {
                    unlink(public_path() . '/' . $user_image);
                }
            }

            Review::where('user_id', $id)->delete();

            Message::where('buyer_id', $id)->delete();
            Message::where('provider_id', $id)->delete();
            JobPost::where('user_id', $id)->delete();
            JobRequest::where('user_id', $id)->delete();

            $orders = Order::where('client_id', $id)->get();

            foreach ($orders as $order) {
                CompleteRequest::where('order_id', $order->id)->delete();
                ProviderClientReport::where('order_id', $order->id)->delete();
                RefundRequest::where('order_id', $id)->delete();

                $tickets = Ticket::where('order_id', $order->id)->get();

                foreach ($tickets as $ticket) {
                    $messages = TicketMessage::where('ticket_id', $ticket->id)->get();
                    foreach ($messages as $message) {
                        $documents = MessageDocument::where('ticket_message_id', $message->id)->get();
                        foreach ($documents as $document) {
                            $document_file = $document->file_name;
                            if ($document_file) {
                                if (File::exists(public_path() . '/' . $document_file)) {
                                    unlink(public_path() . '/' . $document_file);
                                }
                            }
                            $document->delete();
                        }
                        $message->delete();
                    }
                    $ticket->delete();
                }
                $order->delete();
            }

            DB::commit();

            $notification = __('Delete Successfully');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = __('Something went wrong');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param $id
     */
    public function changeStatus($id)
    {
        $customer = User::find($id);
        if ($customer->status == 1) {
            $customer->status = 0;
            $customer->save();
            $message = __('Inactive Successfully');
        } else {
            $customer->status = 1;
            $customer->save();
            $message = __('Active Successfully');
        }
        return response()->json($message);
    }

    public function sendEmailToAllUser()
    {
        return view('admin.customer.send_email_to_all_customer');
    }

    /**
     * @param Request $request
     */
    public function sendMailToAllUser(Request $request)
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

        $users = User::where('status', 1)->get();

        MailHelper::setMailConfig();

        foreach ($users as $user) {
            MailSender::sendMail($user->email, $request->subject, $request->message);
        }

        $notification = __('Email Send Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function sendMailToSingleUser(Request $request, $id)
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

}
