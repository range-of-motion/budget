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

    public static function detectDelimiter(string $line): string
    {
        $delimiters = [
            ';' => 0,
            ',' => 0,
            '\t' => 0,
            '|' => 0,
        ];

        foreach ($delimiters as $delimiter => &$count) {
            $count = substr_count($line, $delimiter);
        }

        return array_search(max($delimiters), $delimiters);
    }
}
