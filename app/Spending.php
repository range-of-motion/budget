<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spending extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'space_id',
        'import_id',
        'tag_id',
        'happened_on',
        'description',
        'amount'
    ];

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedHappenedOnAttribute() {
        $secondsDifference = strtotime(date('Y-m-d')) - strtotime($this->happened_on);

        return ($secondsDifference / 60 / 60 / 24) . ' days ago';
    }

    // Relations
    public function import() {
        return $this->belongsTo(Import::class);
    }

    public function recurring() {
        return $this->belongsTo(Recurring::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
