<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Spending;

class Tag extends Model {
    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
