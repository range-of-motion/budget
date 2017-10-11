<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function earnings() {
        return $this->hasMany('App\Earning');
    }

    public function spendings() {
        return $this->hasMany('App\Spending');
    }

    public function tags() {
        return $this->hasMany('App\Tag');
    }

    public function budgets() {
        return $this->hasMany('App\Budget');
    }

    public function currency() {
        return $this->belongsTo('App\Currency');
    }
}
