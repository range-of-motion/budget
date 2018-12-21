<?php

namespace App;

use App\Events\TagCreated;
use App\Events\TagDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['space_id', 'name'];

    protected $dispatchesEvents = [
        'created' => TagCreated::class,
        'deleted' => TagDeleted::class
    ];

    public function spendings() {
        return $this->hasMany(Spending::class);
    }
}
