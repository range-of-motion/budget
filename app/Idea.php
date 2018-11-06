<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {
    protected $fillable = ['user_id', 'body'];
}
