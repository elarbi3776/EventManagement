<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Enums\EventCategory;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventCreatedMail;
use App\Mail\EventCancelledMail;
use App\Models\User;
use App\Notifications\EventNotification;
use Illuminate\support\Facades\Notification;
use App\Notifications\EventDeletedNotification;
use App\Notifications\EventEditedNotification;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create event')->only('create', 'store');
        $this->middleware('permission:edit event')->only('edit', 'update');
        $this->middleware('permission:delete event')->only('destroy');
    }

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    public function create()
    {
        return view('events.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required',
            'category' => 'nullable|string|in:' . implode(',', array_column(EventCategory::cases(), 'value')),
            'available_tickets' => 'required|integer|min:1',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo1')) {
            $validated['photo1'] = $request->file('photo1')->store('photos', 'public');
        }

        if ($request->hasFile('photo2')) {
            $validated['photo2'] = $request->file('photo2')->store('photos', 'public');
        }

        if (isset($validated['category'])) {
            $validated['category'] = EventCategory::from($validated['category']);
        }

        $event = Event::create($validated);


         // Récupérer tous les utilisateurs
             $users = User::all();

             Notification::send($users, new EventNotification($request->name));
 
        // Envoyer l'e-mail à chaque utilisateur
            foreach ($users as $user) {
            Mail::to($user->email)->send(new EventCreatedMail($event));
        }

        return redirect()->route('organizer.events.index')->with('message', 'Event created successfully.');
    }
    


    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required',
            'category' => 'nullable|string|in:' . implode(',', array_column(EventCategory::cases(), 'value')),
            'available_tickets' => 'nullable|integer',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo1')) {
            $validated['photo1'] = $request->file('photo1')->store('photos', 'public');
        }

        if ($request->hasFile('photo2')) {
            $validated['photo2'] = $request->file('photo2')->store('photos', 'public');
        }

        // Convert the category to the enum instance
        if ($validated['category']) {
            $validated['category'] = EventCategory::from($validated['category']);
        }

        $event->update($validated);

        // Récupérer tous les utilisateurs
        $users = User::all();

        Notification::send($users, new EventEditedNotification($request->name));

        return redirect()->route('organizer.events.index')->with('message', 'Event updated successfully.');
        }

        public function destroy(Event $event)
        {
            $event->delete();
            
             // Récupérer tous les utilisateurs
                $users = User::all();

                Notification::send($users, new EventDeletedNotification($event->name));

             // Envoyer l'e-mail à chaque utilisateur
                foreach ($users as $user) {
                Mail::to($user->email)->send(new EventCancelledMail($event));
        }
            return redirect()->route('organizer.events.index')->with('message', 'Event deleted successfully.');
        }

        public function show()
        {
            $events = Event::all();
            return view('events.show', compact('events'));

        }

        
        public function dashboard_List()
        {
            $events = Event::all();
            $carouselImages = $events->pluck('photo1'); // Extraire les images photo1
        
            return view('dashboard', [
                'events' => $events,
                'carouselImages' => $carouselImages
            ]);}

        public function detail($id)
        {
            $event = Event::findOrFail($id);
            return view('events.detail', compact('event'));
        }
    
         
        public function home_List()
        {
            $events = Event::all();
            return view('home', compact('events'));
        } 
}
