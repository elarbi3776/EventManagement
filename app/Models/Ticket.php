<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'event_name',
        'event_start_date',
        'event_end_date',
        'location',
        'attendee_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}