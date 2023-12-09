<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(DashboardRepository $dashboardRepository, Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $space = $apiKey->user->spaces()->first();

        return response()
            ->json([
                'daily_balance' => $dashboardRepository->getDailyBalance(
                    spaceId: $space->id,
                    year: CarbonImmutable::now()->year,
                    month: CarbonImmutable::now()->month,
                ),
            ]);
    }
}
