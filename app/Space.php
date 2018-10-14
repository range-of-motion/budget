<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Relations
    public function users() {
        return $this->belongsToMany(User::class, 'user_space');
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

    public function earnings() {
        return $this->hasMany(Earning::class);
    }

    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    public function recurrings() {
        return $this->hasMany(Recurring::class);
    }

    public function imports() {
        return $this->hasMany(Import::class);
    }
}
