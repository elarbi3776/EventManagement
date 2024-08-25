@component('mail::message')
    <h1>A New Event Has Been Created</h1>
    <p>Event: {{ $event->name }}</p>
    <p>Date: {{ $event->start_date }}</p>
    <p>Location: {{ $event->location }}</p>
    <p>Visite Our Website and get your ticket</p>
@endcomponent