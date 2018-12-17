<?php

namespace App;

use App\Events\TagCreating;
use App\Events\TagDeleting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['space_id', 'name'];

    protected $dispatchesEvents = [
        'creating' => TagCreating::class,
        'deleting' => TagDeleting::class
    ];

    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
