<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['space_id', 'name'];

    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
