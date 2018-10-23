<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model {
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'name',
        'file',
        'status',
        'column_happened_on',
        'column_description',
        'column_amount'
    ];

    // Relations
    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
