<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_token',
        'last_verification_mail_sent_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //
    public static function getValidationRulesForRegistration(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'currency' => 'required|exists:currencies,id'
        ];
    }

    public static function getValidationRulesForPasswordReset(): array
    {
        return [
            'email' => 'required_without:password|email',
            'password' => 'required_without:email|confirmed'
        ];
    }

    // Accessors
    protected function avatar(): Attribute
    {
        return Attribute::make(
            fn (?string $value) => $value ? '/storage/avatars/' . $value : 'https://via.placeholder.com/250'
        );
    }

    // Relations
    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'user_space')->withPivot('role');
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }
}
