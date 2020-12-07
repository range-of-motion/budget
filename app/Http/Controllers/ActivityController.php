<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::ofSpace(session('space_id'))->get();

        return view('activities.index', ['activities' => $activities]);
    }
}
