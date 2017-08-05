<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model {
    public function tag() {
        return $this->belongsTo('App\Tag');
    }
}
