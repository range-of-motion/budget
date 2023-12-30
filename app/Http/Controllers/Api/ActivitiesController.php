<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $activities = Activity::query()
            ->where('space_id', $apiKey->user->spaces()->first()->id)
            ->get();

        return ActivityResource::collection($activities);
    }
}
