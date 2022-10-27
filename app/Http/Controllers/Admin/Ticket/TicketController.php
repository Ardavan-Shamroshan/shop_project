<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller {
    public function newTickets() {
        $tickets = Ticket::query()->where('seen', 0)->get();
        foreach ($tickets as $newTicket) {
            $newTicket->seen = 1;
            $newTicket->save();
        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets() {
        $tickets = Ticket::query()->where('status', 0)->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets() {
        $tickets = Ticket::query()->where('status', 1)->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tickets = Ticket::all();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function answer(TicketRequest $request, Ticket $ticket) {
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = Auth::id();
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        // dd($inputs);
        Ticket::query()->create($inputs);
        return redirect(route('admin.ticket'))->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket) {
        if ($ticket->seen == 0) {
            $ticket->seen = 1;
            $ticket->save();
            return view('admin.ticket.show', compact('ticket'));
        }
        else
            return view('admin.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function change(Ticket $ticket) {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $ticket->save();
        return redirect(route('admin.ticket'))->with('swal-success', 'وضعیت تیکت با موفقیت تغییر کرد');
    }
}
