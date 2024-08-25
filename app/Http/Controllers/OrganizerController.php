<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        // Récupérer les réservations mensuelles
        $monthlyReservations = Reservation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->all();

        // Récupérer les participations par événement
        $eventAttendance = Event::withCount('reservations') // Utilisation de 'reservations' au lieu de 'registrations'
            ->orderBy('reservations_count', 'desc') // Utilisation de 'reservations_count'
            ->take(3) // Prendre les 3 événements avec le plus de participations
            ->get()
            ->pluck('reservations_count', 'name') // Utilisation de 'reservations_count'
            ->all();
    
        return view('organizer.index', compact('monthlyReservations', 'eventAttendance'));
    }
}
