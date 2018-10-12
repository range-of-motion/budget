<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\Format;

class Spending extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedHappenedOnAttribute() {
        return Format::relativeTimeFormat($this->happened_on);
    }

    // Relations
    public function recurring() {
        return $this->belongsTo(Recurring::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
