<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\Format;

class Earning extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at', 'happened_on'];

    protected $fillable = ['description', 'amount'];

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedHappenedOnAttribute() {
        return Format::relativeTimeFormat($this->happened_on);
    }

    // Relations
    //
}
