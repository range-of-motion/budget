<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
