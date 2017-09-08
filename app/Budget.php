<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Spending;

use Auth;

class Budget extends Model {
    public $timestamps = false;

    public function tag() {
        return $this->belongsTo('App\Tag');
    }

    public function spendings() {
        $user = Auth::user();

        return Spending::where('user_id', $user->id)
            ->whereYear('date', $this->attributes['year'])
            ->whereMonth('date', $this->attributes['month'])
            ->where('tag_id', $this->attributes['tag_id'])
            ->get();
    }
}
