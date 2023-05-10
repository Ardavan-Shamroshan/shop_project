<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Notify\EmailFile;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()->whereNull('ticket_id')->get();
        return view('customer.profile.tickets.my-tickets', compact('tickets'));
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $ticket->save();
        return redirect(route('customer.profile.my-tickets'))->with('swal-success', 'وضعیت تیکت با موفقیت تغییر کرد');
    }


    public function show(Ticket $ticket)
    {
        if ($ticket->seen == 0) {
            $ticket->seen = 1;
            $ticket->save();
            return view('customer.profile.tickets.show-ticket', compact('ticket'));
        } else
            return view('customer.profile.tickets.show-ticket', compact('ticket'));
    }

    public function answer(Request $request, Ticket $ticket)
    {
        $inputs = $request->validate([
            'description' => 'required|max:2048|min:2',
        ]);

        // $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = Auth::id();
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        Ticket::query()->create($inputs);
        return redirect(route('customer.profile.my-tickets'))->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
    }

    public function create()
    {
        $categories = TicketCategory::all();
        $priorities = TicketPriority::all();
        return view('customer.profile.tickets.create', compact('categories', 'priorities'));
    }

    public function store(TicketRequest $request)
    {
        $inputs = $request->all();
        $inputs['reference_id'] = 1;
        $inputs['seen'] = 0;
        $inputs['user_id'] = Auth::id();
        Ticket::query()->create($inputs);
        return to_route('customer.profile.my-tickets')->with('alert-section-success', '  تیکت شما با موفقیت ثبت شد');
    }
}
