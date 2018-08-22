<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model {
    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedHappenedOnAttribute() {
        $secondsDifference = strtotime(date('Y-m-d')) - strtotime($this->happened_on);

        return ($secondsDifference / 60 / 60 / 24) . ' days ago';
    }

    // Mutators
    public function setAmountAttribute($value) {
        if (strpos($value, '.')) {
            $mutated = str_replace('.', '', $value);
        } else {
            $mutated = $value * 100;
        }

        $this->attributes['amount'] = $mutated;
    }

    // Relations
    //
}
