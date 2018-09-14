<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Earning;
use App\Spending;
use App\Tag;
use App\Budget;
use App\Currency;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function earnings() {
        return $this->hasMany(Earning::class);
    }

    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    public function recurrings() {
        return $this->hasMany(Recurring::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

    public function budgets() {
        return $this->hasMany(Budget::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
