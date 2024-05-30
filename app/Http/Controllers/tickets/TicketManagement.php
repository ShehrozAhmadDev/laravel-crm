<?php

namespace App\Http\Controllers\tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketManagement extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function TicketManagement()
  {
    $tickets = Ticket::all();
    // $userCount = $users->count();
    // $verified = User::whereNotNull('email_verified_at')->get()->count();
    // $notVerified = User::whereNull('email_verified_at')->get()->count();
    // $usersUnique = $users->unique(['email']);
    // $userDuplicates = $users->diff($usersUnique)->count();

    return view('content.tickets.tickets');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'title',
      3 => 'description',
      4 => 'ticket_type',
      5 => 'client',
      6 => 'assign_to',
      7 => 'labels',
    ];

    $search = [];

    $totalData = Ticket::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $tickets = Ticket::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $tickets = Ticket::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Ticket::where('id', 'LIKE', "%{$search}%")
        ->orWhere('title', 'LIKE', "%{$search}%")
        ->orWhere('description', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = [];

    if (!empty($tickets)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($tickets as $ticket) {
        $nestedData['id'] = $ticket->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['title'] = $ticket->title;
        $nestedData['description'] = $ticket->description;
        $nestedData['ticket_type'] = $ticket->ticket_type;
        $nestedData['client'] = $ticket->client;
        $nestedData['assign_to'] = $ticket->assign_to;
        $nestedData['labels'] = $ticket->labels;
        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $ticketId = $request->id;
  
      if ($ticketId) {
          // Update the ticket
          $ticket = Ticket::updateOrCreate(
              ['id' => $ticketId],
              ['title' => $request->title, 'description' => $request->description , 'client' => $request->client, 'ticket_type' => $request->ticket_type, 'labels' => $request->labels, 'assign_to' => $request->assign_to]
          );
  
          return response()->json('Updated');
      } else {
          // Create a new ticket if the title is unique
          $ticketTitle = Ticket::where('title', $request->title)->first();
  
          if (empty($ticketTitle)) {
              $ticket = Ticket::create([
                'title' => $request->title, 'description' => $request->description , 'client' => $request->client, 'ticket_type' => $request->ticket_type, 'labels' => $request->labels, 'assign_to' => $request->assign_to
              ]);
  
              return response()->json('Created');
          } else {
              return response()->json(['message' => 'already exists'], 422);
          }
      }
  }
  
  

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['id' => $id];

    $users = Ticket::where($where)->first();

    return response()->json($users);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $users = Ticket::where('id', $id)->delete();
  }
}
