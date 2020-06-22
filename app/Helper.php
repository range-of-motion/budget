<?php

namespace App;

class Helper
{
    public static function formatNumber($number): string
    {
        return number_format($number, 2, '.', '');
    }

    public static function rawNumberToInteger(float $rawNumber): int
    {
        return (int) round($rawNumber * 100);
    }
}
