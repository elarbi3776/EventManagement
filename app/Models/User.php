<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory,HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
   


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getAvatarUrlAttribute()
{
    $avatarFolder = config('chatify.user_avatar.folder');
    $defaultAvatar = config('chatify.user_avatar.default');
    return $this->avatar 
        ? asset('storage/' . $avatarFolder . '/' . $this->avatar) 
        : asset('storage/' . $avatarFolder . '/' . $defaultAvatar);
}

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}
