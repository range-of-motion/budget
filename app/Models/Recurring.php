<?php

namespace App\Models;

use App\Events\RecurringCreated;
use App\Events\RecurringDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Model {
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'type',
        'interval',
        'day',
        'starts_on',
        'ends_on',
        'tag_id',
        'description',
        'amount'
    ];

    protected $dates = ['deleted_at'];

    protected $dispatchesEvents = [
        'created' => RecurringCreated::class,
        'deleted' => RecurringDeleted::class
    ];

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

    public function getStatusAttribute() {
        return $this->starts_on <= date('Y-m-d') && ($this->ends_on >= date('Y-m-d') || !$this->ends_on);
    }

    // Relations
    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
