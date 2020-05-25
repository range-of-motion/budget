<?php

namespace App;

class Helper {
    public static function formatNumber($number): string
    {
        return number_format($number, 2, '.', '');
    }
}
