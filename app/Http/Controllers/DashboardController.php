<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    private $dashboardRepository;
    private $tagRepository;

    public function __construct(DashboardRepository $dashboardRepository, TagRepository $tagRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
        $this->tagRepository = $tagRepository;
    }

    public function __invoke(Request $request)
    {
        $space_id = session('space_id');
        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        $mostExpensiveTags = $this->tagRepository->getMostExpensiveTags($space_id, 3, $currentYear, $currentMonth);

        return view('dashboard', [
            'month' => date('n'),

            'widgets' => $request->user()->widgets()->orderBy('sorting_index')->get(),

            'totalSpent' => $this->dashboardRepository->getTotalAmountSpent($currentYear, $currentMonth),
            'mostExpensiveTags' => $mostExpensiveTags,

            'daysInMonth' => $daysInMonth,
            'dailyBalance' => $this->dashboardRepository->getDailyBalance(
                session('space_id'),
                $currentYear,
                $currentMonth,
            )
        ]);
    }
}
