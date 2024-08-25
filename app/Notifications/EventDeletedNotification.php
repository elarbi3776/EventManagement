<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventDeletedNotification extends Notification
{
    use Queueable;

    private $eventName;
    /**
     * Create a new notification instance.
     */
    public function __construct($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

   
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->eventName,
            'message' => "The event '{$this->eventName}' has been deleted.",
        ];
    }
}
