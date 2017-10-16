<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model {
    public $timestamps = false;

    public function tag() {
        return $this->belongsTo('App\Tag');
    }
}
