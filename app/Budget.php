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

        $date = $this->attributes['date'];

        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        return Spending::where('user_id', $user->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('tag_id', $this->attributes['tag_id'])
            ->get();
    }
}
