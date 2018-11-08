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

    //
    public function monthlyBalance($year, $month) {
        $query = DB::selectOne('
            SELECT (
                SELECT SUM(amount) 
                FROM earnings
                WHERE space_id = :e_space_id AND YEAR(happened_on) = :e_year AND MONTH(happened_on) = :e_month
            ) - (
                SELECT SUM(amount) 
                FROM spendings
                WHERE space_id = :s_space_id AND YEAR(happened_on) = :s_year AND MONTH(happened_on) = :s_month
            ) AS balance;
        ', ['e_space_id' => $this->id, 'e_year' => $year, 'e_month' => $month, 's_space_id' => $this->id, 's_year' => $year, 's_month' => $month]);

        return $query->balance;
    }

    public function monthlyRecurrings($year, $month) {
        $query = DB::selectOne('
            SELECT SUM(amount) as amount
            FROM recurrings
            WHERE space_id = :space_id AND YEAR(starts_on) >= :start_year AND MONTH(starts_on) >= :start_month AND ((YEAR(ends_on) <= :end_year AND MONTH(ends_on) <= :end_month) OR ends_on IS NULL)
        ', ['space_id' => $this->id, 'start_year' => $year, 'start_month' => $month, 'end_year' => $year, 'end_month' => $month]);

        return $query->amount;
    }
}
