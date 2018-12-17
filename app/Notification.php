<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    public function space() {
        return $this->belongsTo(Space::class);
    }
}
