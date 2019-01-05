<?php

namespace App\Repositories;

use Carbon\Carbon;

class TransactionRepository {
    public function getTransactionsByYearMonth($filterBy = null) {
        $yearMonths = [];

        // Populate yearMonths with earnings
        foreach (session('space')->earnings as $earning) {
            $shouldAdd = false;

            if (!$filterBy) {
                $shouldAdd = true;
            }

            if ($shouldAdd) {
                $i = Carbon::parse($earning->happened_on)->format('Y-m');

                if (!isset($yearMonths[$i])) {
                    $yearMonths[$i] = [];
                }

                $yearMonths[$i][] = $earning;
            }
        }

        // Populate yearMonths with spendings
        foreach (session('space')->spendings as $spending) {
            $shouldAdd = true;

            // Filter
            if ($filterBy[0] == 'tag') {
                if (!$spending->tag || $spending->tag->id != $filterBy[1]) {
                    $shouldAdd = false;
                }
            }

            if ($shouldAdd) {
                $i = Carbon::parse($spending->happened_on)->format('Y-m');

                if (!isset($yearMonths[$i])) {
                    $yearMonths[$i] = [];
                }

                $yearMonths[$i][] = $spending;
            }
        }

        // Sort transactions
        foreach ($yearMonths as &$yearMonth) {
            usort($yearMonth, function ($a, $b) {
                return $a->happened_on < $b->happened_on;
            });
        }

        // Sort yearMonths
        krsort($yearMonths);

        return $yearMonths;
    }
}
