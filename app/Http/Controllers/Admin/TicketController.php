<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageDocument;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $tickets = Ticket::with('user', 'order')->orderBy('id', 'desc')->get();

        return view('admin.ticket.ticket', compact('tickets'));
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        $ticket = Ticket::with('user', 'order')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_admin' => 1]);
        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();

        return view('admin.ticket.show_ticket', compact('ticket', 'messages'));
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Ticket::where('id', $id)->delete();
        TicketMessage::where('ticket_id', $id)->delete();

        $notification = __('Delete Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.ticket')->with($notification);
    }

    /**
     * @param $id
     */
    public function closed($id)
    {
        $ticket         = Ticket::where('id', $id)->first();
        $ticket->status = 'closed';
        $ticket->save();

        $notification = __('Closed Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->route('admin.ticket')->with($notification);
    }

    /**
     * @param Request $request
     */
    public function storeMessage(Request $request)
    {
        $rules = [
            'ticket_id' => 'required',
            'message'   => 'required',
            'user_id'   => 'required',
            'documents' => 'max:2048',
        ];
        $customMessages = [
            'message.required'   => __('Message is required'),
            'ticket_id.required' => __('Ticket is required'),
            'user_id.required'   => __('User is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $admin                 = Auth::guard('admin')->user();
        $message               = new TicketMessage();
        $message->ticket_id    = $request->ticket_id;
        $message->admin_id     = $admin->id;
        $message->user_id      = $request->user_id;
        $message->message      = $request->message;
        $message->message_from = 'admin';
        $message->unseen_admin = 1;
        $message->save();

        if ($request->hasFile('documents')) {
            foreach ($request->documents as $request_file) {
                $extention       = $request_file->getClientOriginalExtension();
                $file_name       = 'support-file-' . time() . '.' . $extention;
                $destinationPath = public_path('uploads/custom-images/');
                $request_file->move($destinationPath, $file_name);

                $document                    = new MessageDocument();
                $document->ticket_message_id = $message->id;
                $document->file_name         = $file_name;
                $document->save();
            }
        }

        $firstSmsExist = TicketMessage::where('admin_id', '!=', 0)->where('ticket_id', $request->ticket_id)->count();

        if ($firstSmsExist == 1) {
            $ticket         = Ticket::where(['id' => $request->ticket_id])->first();
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        $notification = __('Message Send Successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

}
