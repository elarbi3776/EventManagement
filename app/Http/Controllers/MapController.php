<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $events = Event::all(['name', 'latitude', 'longitude', 'description']);
        return view('map', compact('events'));
        
    }
}
