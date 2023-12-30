<?php

namespace App\Models;

use App\Events\RecurringCreated;
use App\Events\RecurringDeleted;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'type',
        'interval',
        'day',
        'starts_on',
        'ends_on',
        'last_used_on',
        'tag_id',
        'description',
        'amount',
        'currency_id'
    ];

    protected $dispatchesEvents = [
        'created' => RecurringCreated::class,
        'deleted' => RecurringDeleted::class
    ];

    // Accessors
    protected function dueDays(): Attribute
    {
        return Attribute::make(function () {
            if ($this->starts_on <= date('Y-m-d') && ($this->ends_on >= date('Y-m-d') || !$this->ends_on)) {
                if (date('j') > $this->day) {
                    return date('t') - date('j') + $this->day;
                }

                return $this->day - date('j');
            }

            return 0;
        });
    }

    protected function status(): Attribute
    {
        return Attribute::make(function () {
            return $this->starts_on <= date('Y-m-d') && ($this->ends_on >= date('Y-m-d') || !$this->ends_on);
        });
    }

    // Relations
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
