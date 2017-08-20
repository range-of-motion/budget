<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Spending;

use Auth;

class Budget extends Model {
    public function tag() {
        return $this->belongsTo('App\Tag');
    }

    public function spendings() {
        $user = Auth::user();

        return Spending::where('user_id', $user->id)
            ->where('year', $this->attributes['year'])
            ->where('month', $this->attributes['month'])
            ->where('tag_id', $this->attributes['tag_id'])
            ->get();
    }
}
