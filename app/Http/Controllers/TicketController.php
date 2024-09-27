<?php

namespace App\Http\Controllers;

use App\Mail\SupportTicketSystemMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller {
    function index() {
        $loggedInUser = Auth::user();
        if ($loggedInUser->role == 'admin') {
            $tickets = Ticket::select('tickets.*', 'users.name as user_name')
                ->leftJoin('users', 'users.id', '=', 'tickets.user_id')
                ->get();
        } else {
            $tickets = Ticket::select('tickets.*', 'users.name as user_name')
                ->leftJoin('users', 'users.id', '=', 'tickets.user_id')
                ->where('user_id', $loggedInUser->id)
                ->get();
        }

        return view('ticket.index', compact('tickets'));
    }

    function add() {
        return view('ticket.add');
    }

    function save(Request $request) {
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        $admin = User::where('role', 'admin')->first();
        $toEmail = $admin->email;
        $subject = "Ticket Opened";

        Mail::to($toEmail)->send(new SupportTicketSystemMail($subject, $ticket, Auth::User()));

        if ($ticket) {
            return redirect(route('ticket.index'))->with('success', 'Successfully opned a ticket!');
        } else {
            return redirect(route('ticket.add'))->with('error', 'Ticket not opened, somthing went wrong!');
        }

    }

    function edit($id) {
        $ticket = Ticket::find($id);
        return view('ticket.edit', compact('ticket'));
    }

    function update(Request $request) {
        $id = $request->id;
        $ticket = Ticket::whereId($id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($ticket) {
            return redirect(route('ticket.index'))->with('success', 'Successfully opned a ticket!');
        } else {
            return redirect(route('ticket.edit', ['id', $id]))->with('error', 'Ticket not opened, somthing went wrong!');
        }
    }

    function response($id) {
        $ticket = Ticket::find($id);
        return view('ticket.response', compact('ticket'));
    }

    function saveResponse(Request $request) {
        $id = $request->id;
        $ticket = Ticket::whereId($id)->update([
            'response' => $request->response,
        ]);

        if ($ticket) {
            return redirect(route('ticket.index'))->with('success', 'Successfully saved ticket response!');
        } else {
            return redirect(route('ticket.edit', ['id', $id]))->with('error', 'Ticket response not saved, somthing went wrong!');
        }
    }

    function status($id) {
        $ticket = Ticket::find($id);

        $ticket->status = $ticket->status == 'open' ? 'closed' : 'open';
        $ticket->update();

        $customer = User::where('id', $ticket->user_id)->first();
        $toEmail = $customer->email;
        $subject = "Ticket Closed";

        Mail::to($toEmail)->send(new SupportTicketSystemMail($subject, $ticket, $customer));
        return redirect(route('ticket.index'))->with('success', ucwords("Ticket $ticket->status"));
    }
}
