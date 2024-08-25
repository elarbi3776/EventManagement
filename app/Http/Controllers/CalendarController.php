<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        $query = Event::query();
    
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date]);
        }
    
        // Filter for events with user reservations
        if ($request->has('user_reservations')) {
            $user = auth()->user();
            $query->whereHas('reservations', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
    
        $events = $query->get();
    
        $calendarEvents = [];
    
        foreach ($events as $event) {
            $calendarEvents[] = [
                'title' => $event->name,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
        }
    
        return response()->json($calendarEvents);
    }
    
}
