<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    protected $fillable = ['space_id', 'user_id', 'action'];

    public function space() {
        return $this->belongsTo(Space::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
