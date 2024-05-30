<?php

namespace App\Http\Controllers\events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event; 


class EventsCalendar extends Controller
{
  public function index()
  {
    $events = Event::all();
    $labels = $events->pluck('label')->unique();
    return view('content.events.events', compact('events', 'labels'));  }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

}
