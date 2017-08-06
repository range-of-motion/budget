<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller {
    public function index() {
        return view('reports.index');
    }

    public function show($year, $month) {
        return view('reports.show', [
            'year' => $year,
            'month' => $month
        ]);
    }
}
