<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model {
    protected $fillable = ['user_id', 'ip', 'failed'];
}
