<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function list()
{
    $tickets = Ticket::select(['id', 'title', 'client', 'ticket_type', 'description', 'assign_to', 'labels'])->get();
    return datatables()->of($tickets)
        ->addColumn('action', function ($ticket) {
            return '<button class="btn btn-sm btn-icon edit-record" data-id="' . $ticket->id . '"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-sm btn-icon delete-record" data-id="' . $ticket->id . '"><i class="ti ti-trash"></i></button>';
        })
        ->make(true);
}


    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());
        return response()->json($ticket, 201);
    }

    public function show($id)
    {
        return Ticket::find($id);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return response()->json($ticket, 200);
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(null, 204);
    }
}
