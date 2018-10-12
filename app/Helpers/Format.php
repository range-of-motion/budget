<?php

namespace App\Helpers;

class Format
{
    public static function relativeTimeFormat($input_date)
    {
        $ts = strtotime($input_date);
        $diff = strtotime('00:05:00') - $ts;

        $translator = app('translator');


        if ($diff >= 0) {
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 3600) {
                    $time = floor($diff / 60);
                    return $translator->choice('times.x_minutes_ago', $time);
                }
                if ($diff < 86400) {
                    $time = floor($diff / 3600);
                    return $translator->choice('times.x_hours_ago', $time);
                }
            }
            if ($day_diff < 7) {
                return $translator->choice('times.x_days_ago', $day_diff);
            }
            if ($day_diff < 31) {
                $time = floor($day_diff / 7);
                return $translator->choice('times.x_weeks_ago', $time);
            }
            if ($day_diff < 60) {
                return __('times.last_month');
            }
            return date('Y-m-d', $ts);
        } else {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 3600) {
                    $time = floor($diff / 60);
                    return $translator->choice('times.in_x_minutes', $time);
                }
                if ($diff < 86400) {
                    $time = floor($diff / 3600);
                    return $translator->choice('times.in_x_hours', $time);
                }
            }
            if ($day_diff < 4) {
                $day = date('N', $ts);
                $weekdays = $translator->get('calendar.weekdays');
                return $weekdays[$day];
            }
            if ($day_diff < 7 + (7 - date('w'))) {
                return $translator->choice('times.in_x_days', $day_diff);
            }
            if (ceil($day_diff / 7) < 4) {
                $time = ceil($day_diff / 7);
                return $translator->choice('times.in_x_weeks', $time);
            }
            if (date('n', $ts) == date('n') + 1) {
                return __('times.next_month');
            }
            return date('Y-m-d', $ts);
        }
    }
}
