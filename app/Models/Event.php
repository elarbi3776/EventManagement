<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EventCategory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'start_date', 'end_date','location','category','available_tickets','photo1', 'photo2', 'latitude',
    'longitude',];

   
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'category' => EventCategory::class,
    ];
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
