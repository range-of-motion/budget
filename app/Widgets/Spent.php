<?php

namespace App\Widgets;

use App\Helper;
use App\Models\Space;
use App\Models\Spending;

class Spent
{
    private $properties;

    public function __construct(object $properties)
    {
        $this->properties = $properties;
    }

    public function render()
    {
        $space = Space::find(session('space_id'));

        $currencySymbol = $space->currency->symbol;

        if ($this->properties->period === 'today') {
            $spent = Spending::query()
                ->where('space_id', session('space_id'))
                ->whereRaw('DATE(happened_on) = ?', [date('Y-m-d')])
                ->sum('amount');
        }

        if ($this->properties->period === 'this_week') {
            $monday = date('Y-m-d', strtotime('monday this week'));
            $sunday = date('Y-m-d', strtotime('sunday this week'));

            $spent = Spending::query()
                ->where('space_id', session('space_id'))
                ->whereRaw('DATE(happened_on) >= ? AND DATE(happened_ON) <= ?', [$monday, $sunday])
                ->sum('amount');
        }

        if ($this->properties->period === 'this_month') {
            $spent = Spending::query()
                ->where('space_id', session('space_id'))
                ->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [date('Y'), date('n')])
                ->sum('amount');
        }

        return view('widgets.spent', [
            'currencySymbol' => $currencySymbol,
            'spent' => Helper::formatNumber($spent / 100),
            'period' => str_replace('_', ' ', $this->properties->period)
        ]);
    }
}
