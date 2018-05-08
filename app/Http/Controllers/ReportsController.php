<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class ReportsController extends Controller {
    public function get() {
        $user = Auth::user();

        $currentYear = date('Y');

        //
        $monthlyEarnings = [];

        for ($i = 1; $i <= 12; $i ++) {
            $monthlyEarnings[] = $user
                ->earnings()
                ->whereRaw('MONTH(date) = ?', [$i])
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->sum('amount');
        }

        $monthlySpendings = [];

        for ($i = 1; $i <= 12; $i ++) {
            $monthlySpendings[] = $user
                ->spendings()
                ->whereRaw('MONTH(date) = ?', [$i])
                ->whereRaw('YEAR(date) = ?', [$currentYear])
                ->sum('amount');
        }

        //
        $tl = [];
        $tc = [];
        $td = [];

        foreach ($user->spendings()->whereRaw('YEAR(date)', [$currentYear])->whereNotNull('tag_id')->get() as $spending) {
            $hit = null;

            for ($i = 0; $i < count($tl); $i ++) {
                if ($tl[$i] == $spending->tag->name) {
                    $hit = $i;

                    break;
                }
            }

            if (!is_numeric($hit)) {
                $tl[] = $spending->tag->name;
                $tc[] = '#' . dechex(rand(0x000000, 0xFFFFFF));
                $td[] = $spending->amount;
            } else {
                $td[$i] += $spending->amount;
            }
        }

        //
        return view('reports', compact('currentYear', 'monthlyEarnings', 'monthlySpendings', 'tl', 'tc', 'td'));
    }
}
