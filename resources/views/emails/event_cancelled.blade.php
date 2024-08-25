@component('mail::message')
<h1>An Event Has Been Cancelled</h1>
<p>Event: {{ $event->name }}</p>
<p>Date: {{ $event->start_date }}</p>
<p>Location: {{ $event->location }}</p>
<p>We apologize for any inconvenience caused.</p>
@endcomponent