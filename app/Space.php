<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Relations
    public function tags() {
        return $this->hasMany(Tag::class);
    }

    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
