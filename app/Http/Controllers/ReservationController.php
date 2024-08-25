<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('permission:reserve ticket')->only('reserve');
    }

    public function reserve(Event $event)
    {
        if ($event->available_tickets > 0) {
            $reservation = new Reservation();
            $reservation->user_id = auth()->id();
            $reservation->event_id = $event->id;
            $reservation->save();
    
            $event->decrement('available_tickets');
    
            return redirect()->route('participant.tickets.create', ['event_id' => $event->id, 'reservation_id' => $reservation->id]);
        }
    
        return redirect()->route('events.show', $event->id)->with('error', 'No tickets available.');
    }
    
    

    public function index()
    {
        $reservations = Auth::user()->reservations;
        return view('reservations.index', compact('reservations'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reservation->delete();

        return redirect()->route('participant.reservations.index')->with('success', 'Reservation cancelled successfully.');
    }

    
}