<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display the specified notification.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Manually retrieve the notification
        $notification = DatabaseNotification::where('id', $id)
            ->where('notifiable_id', auth()->id())
            ->firstOrFail();
    
        // Optionally mark the notification as read
        if ($notification->unread()) {
            $notification->markAsRead();
        }
    
        // Return a view or redirect as needed
        return view('notifications.show', ['notification' => $notification]);
    }
}
