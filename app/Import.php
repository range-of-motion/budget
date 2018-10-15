<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model {
    use SoftDeletes;

    protected $fillable = ['space_id', 'name', 'file'];
}
