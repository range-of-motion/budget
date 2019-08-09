<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
    protected $fillable = ['space_id', 'user_id', 'entity_id', 'entity_type', 'action'];

    public function space() {
        return $this->belongsTo(Space::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCreatedAtAttribute() {
        $date1 = strtotime($this->created_at);
        $date2 = strtotime('now');

        // Formulate the difference between two dates
        $diff = abs($date2 - $date1);

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24)/ (60 * 60 * 24));
        $hours = floor(($diff - $years * 365 * 60 * 60 *24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60)/ 60);
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));

        if ($years > 1) {
            $timeAttribute = $years . ' ' . trans_choice('general.time.year', $years);
        } elseif ($months > 1) {
            $timeAttribute = $months . ' ' . trans_choice('general.time.month', $months);
        } elseif ($days > 1) {
            $timeAttribute = $days . ' ' . trans_choice('general.time.day', $days);
        } elseif ($hours > 1) {
            $timeAttribute = $hours . ' ' . trans_choice('general.time.hour', $hours);
        } elseif ($minutes > 1) {
            $timeAttribute = $minutes . ' ' . trans_choice('general.time.minute', $minutes);
        } else {
            $timeAttribute = $seconds . ' ' . trans_choice('general.time.second', $seconds);
        }

        return $timeAttribute . ' ' . trans('general.time.ago');
    }
}
