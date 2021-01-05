<?php

namespace App\Widgets;

use App\Helper;
use App\Models\Space;
use App\Repositories\DashboardRepository;

class Balance
{
    private $dashboardRepository;

    public function __construct()
    {
        $this->dashboardRepository = new DashboardRepository();
    }

    public function render()
    {
        $space = Space::find(session('space_id'));

        $currencySymbol = $space->currency->symbol;
        $balance = $this->dashboardRepository->getBalance(date('Y'), date('n'));

        return view('widgets.balance', [
            'currencySymbol' => $currencySymbol,
            'balance' => Helper::formatNumber($balance / 100)
        ]);
    }
}
