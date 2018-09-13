<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
