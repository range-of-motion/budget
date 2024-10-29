<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Spending;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $space = Auth::user()->spaces()->first();

        $yearMonth = now()->format('F Y');

        $earnings = Earning::query()
            ->where('space_id', $space->id)
            ->whereBetween('happened_on', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $spendings = Spending::query()
            ->where('space_id', $space->id)
            ->whereBetween('happened_on', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $tags = Spending::query()
            ->where('space_id', $space->id)
            ->whereNotNull('tag_id')
            ->whereBetween('happened_on', [now()->startOfMonth(), now()->endOfMonth()])
            ->get()
            ->groupBy('tag_id')
            ->map(fn (Collection $s) => [
                'name' => $s->first()->tag->name,
                'amount' => sprintf('%s %s', $space->currency->symbol, number_format($s->sum('amount') / 100, 2)),
                'percentage' => round(($s->sum('amount') / $spendings) * 100, 1),
            ])
            ->sortByDesc('percentage')
            ->values()
            ->all();

        return Inertia::render(
            'Dashboard',
            [
                'yearMonth' => $yearMonth,
                'earnings' => sprintf('%s%s', '$', number_format($earnings / 100, 2)),
                'spendings' => sprintf('%s%s', '$', number_format($spendings / 100, 2)),
                'net' => sprintf('%s%s', '$', number_format(($earnings - $spendings) / 100, 2)),
                'tags' => $tags,
            ],
        );
    }
}
