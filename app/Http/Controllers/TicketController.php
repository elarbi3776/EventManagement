<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    public function create($event_id, $reservation_id)
    {
        $event = Event::findOrFail($event_id);
        $reservation = Reservation::findOrFail($reservation_id);
    
        // Affiche la vue pour créer un ticket, passer les données nécessaires à la vue
        return view('tickets.create', compact('event', 'reservation'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'reservation_id' => 'required|exists:reservations,id',
        'attendee_name' => 'required|string',
    ]);

    $event = Event::findOrFail($request->event_id);
    $reservation = Reservation::findOrFail($request->reservation_id);
    $user = auth()->user();

    $ticket = new Ticket();
    $ticket->user_id = $user->id;
    $ticket->user_email = $user->email;
    $ticket->event_name = $event->name;
    $ticket->event_start_date = $event->start_date;
    $ticket->event_end_date = $event->end_date;
    $ticket->location = $event->location;
    $ticket->attendee_name = $request->attendee_name;
    $ticket->reservation_id = $reservation->id;
    $ticket->save();

    $reservation->ticket_id = $ticket->id;
    $reservation->save();

    // Génération du code QR
    $qrCode = new QrCode($event->name);
    $qrCode->setSize(200);
    $writer = new PngWriter();
    $qrCodeDataUri = $writer->write($qrCode)->getDataUri();

    return redirect()->route('participant.tickets.create', [
        'event_id' => $event->id,
        'reservation_id' => $reservation->id
    ])->with([
        'success' => 'Ticket created successfully.',
        'ticket_id' => $ticket->id,
        'qrCodeDataUri' => $qrCodeDataUri
    ]);
}

    

    public function downloadTicket($id)
    {
        // Find the ticket by ID
        $ticket = Ticket::findOrFail($id);
        $reservation = $ticket->reservation;
        $event = $reservation->event;

        // Generate the QR Code
        $qrCode = new QrCode($event->name);
        $qrCode->setSize(200);
        $writer = new PngWriter();
        $qrCodeDataUri = $writer->write($qrCode)->getDataUri();

        // Load the PDF view with the ticket details
        $pdf = Pdf::loadView('pdf.ticket', compact('event', 'qrCodeDataUri', 'reservation', 'ticket'));

        // Download the PDF
        return $pdf->download('ticket_' . $ticket->id . '.pdf');
    }

}
