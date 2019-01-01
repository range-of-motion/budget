<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller {
    public function index() {
        $yearMonths = [];

        // Populate yearMonths with earnings
        foreach (session('space')->earnings as $earning) {
            $i = Carbon::parse($earning->happened_on)->format('Y-m');

            if (!isset($yearMonths[$i])) {
                $yearMonths[$i] = [];
            }

            $yearMonths[$i][] = $earning;
        }

        // Populate yearMonths with spendings
        foreach (session('space')->spendings as $spending) {
            $i = Carbon::parse($spending->happened_on)->format('Y-m');

            if (!isset($yearMonths[$i])) {
                $yearMonths[$i] = [];
            }

            $yearMonths[$i][] = $spending;
        }

        // Sort transactions
        foreach ($yearMonths as &$yearMonth) {
            usort($yearMonth, function ($a, $b) {
                return $a->happened_on < $b->happened_on;
            });
        }

        // Sort yearMonths
        krsort($yearMonths);

        return view('transactions.index', compact('yearMonths'));
    }

    public function create() {
        $tags = [];

        foreach (session('space')->tags as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: #' . $tag->color . ';"></div></div><div class="row__column row__column--middle">' . $tag->name . '</div></div>'];
        }

        return view('transactions.create', compact('tags'));
    }
}
