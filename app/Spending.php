<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model {
    public $timestamps = false;

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    // Relations
    public function tag() {
        return $this->belongsTo('App\Tag');
    }
}
