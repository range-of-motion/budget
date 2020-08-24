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
        'last_verification_mail_sent_at',
        'stripe_customer_id',
        'plan'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'plan' => 'standard'
    ];

    // Accessors
    public function getAvatarPathAttribute($avatar)
    {
        return $avatar ? '/storage/avatars/' . $avatar : 'https://via.placeholder.com/250';
    }

    // Relations
    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'user_space')->withPivot('role');
    }
}
