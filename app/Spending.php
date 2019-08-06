<?php

namespace App;

use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
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

    protected $dispatchesEvents = [
        'created' => TransactionCreated::class,
        'deleted' => TransactionDeleted::class
    ];

    // Accessors
    public function getFormattedAmountAttribute() {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedHappenedOnAttribute() {
        $today = strtotime(date('Y-m-d'));

        if (strtotime($this->happened_on) > $today) {
            $timeAspect = 'future';
        } elseif (strtotime($this->happened_on) == $today) {
            $timeAspect = 'today';
        } else {
            $timeAspect = 'past';
        }

        $diff = abs($today - strtotime($this->happened_on));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $timeAttribute = "";

        if ($years > 0) {
            $timeAttribute .= $years . ' ' . trans_choice('general.time.year', $years);
        }
        if ($months > 0) {
            if ($timeAttribute !== "") {
                $timeAttribute .= ' and ';
            }
            $timeAttribute .= $months . ' ' . trans_choice('general.time.month', $months);
        }
        if ($days > 0) {
            if ($timeAttribute !== "") {
                $timeAttribute .= ' and ';
            }
            if ($timeAspect == 'past') {
                $days -= 1;
            }
            $timeAttribute .= $days . ' ' . trans_choice('general.time.day', $days);
        }

        if ($timeAspect =='future') {
            return $timeAttribute . ' ' . trans('general.time.ahead');
        } elseif ($timeAspect == 'today') {
            return trans('general.time.today');
        } else {
            return $timeAttribute . ' ' . trans('general.time.ago');
        }
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
