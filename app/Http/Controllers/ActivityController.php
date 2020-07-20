<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::ofSpace(session('space_id'))->get();

        return view('activities.index', ['activities' => $activities]);
    }
}
