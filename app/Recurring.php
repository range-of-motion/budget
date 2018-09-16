<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Accessors
    public function getDueDaysAttribute() {
        if ($this->starts_on <= date('Y-m-d') && ($this->ends_on >= date('Y-m-d') || !$this->ends_on)) {
            if (date('j') > $this->day) {
                return date('t') - date('j') + $this->day;
            }

            return $this->day - date('j');
        }

        return 0;
    }

    // Relations
    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
