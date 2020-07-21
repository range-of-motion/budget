<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_token',
        'last_verification_mail_sent_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Accessors
    public function getAvatarAttribute($avatar)
    {
        return $avatar ? '/storage/avatars/' . $avatar : 'https://via.placeholder.com/250';
    }

    // Relations
    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'user_space')->withPivot('role');
    }
}
