<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Space extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Relations
    public function users() {
        return $this->belongsToMany(User::class, 'user_space');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

    public function earnings() {
        return $this->hasMany(Earning::class);
    }

    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    public function recurrings() {
        return $this->hasMany(Recurring::class);
    }

    public function imports() {
        return $this->hasMany(Import::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    //
    public function monthlyBalance($year, $month) {
        $earnings_amount = DB::table('earnings')
            ->where('space_id', $this->id)
            ->whereYear('happened_on', $year)
            ->whereMonth('happened_on', $month)
            ->sum('amount');

        $spendings_amount = DB::table('spendings')
            ->where('space_id', $this->id)
            ->whereYear('happened_on', $year)
            ->whereMonth('happened_on', $month)
            ->sum('amount');

        if($spendings_amount === null) {
            return $earnings_amount;
        } else {
            return $earnings_amount - $spendings_amount;
        }
    }

    public function monthlyRecurrings($year, $month) {
        $query = DB::selectOne('
            SELECT SUM(amount) as amount
            FROM recurrings
            WHERE space_id = :space_id AND YEAR(starts_on) <= :start_year AND MONTH(starts_on) <= :start_month AND ((YEAR(ends_on) >= :end_year AND MONTH(ends_on) >= :end_month) OR ends_on IS NULL)
        ', ['space_id' => $this->id, 'start_year' => $year, 'start_month' => $month, 'end_year' => $year, 'end_month' => $month]);

        return $query->amount;
    }
}
