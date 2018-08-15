<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model {
    public $timestamps = false;

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    // Relations
    //
}
