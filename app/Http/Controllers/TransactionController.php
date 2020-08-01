<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Space;
use App\Models\Spending;
use App\Models\Tag;
use App\Repositories\CurrencyRepository;
use App\Repositories\RecurringRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private $currencyRepository;
    private $recurringRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        CurrencyRepository $currencyRepository,
        RecurringRepository $recurringRepository
    ) {
        $this->repository = $transactionRepository;
        $this->currencyRepository = $currencyRepository;
        $this->recurringRepository = $recurringRepository;
    }

    public function index(Request $request)
    {
        $periods = DB::select('
            SELECT
                YEAR(happened_on) AS year,
                MONTH(happened_on) AS month
            FROM earnings
            GROUP BY year, month
            ORDER BY year DESC, month DESC;
        ');

        foreach ($periods as $period) {
            // Earnings
            $earnings = Earning::ofSpace(session('space_id'))
                ->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$period->year, $period->month])
                ->get();

            $earnings->map(function ($earning) {
                $earning->type = 'earning';
            });

            // Spendings
            $spendings = Spending::ofSpace(session('space_id'))
                ->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$period->year,$period->month])
                ->with('tag')
                ->get();

            $spendings->map(function ($spending) {
                $spending->type = 'spending';
            });

            // Concat earnings and spendings
            $transactions = $earnings->concat($spendings);

            $sortedTransactions = $transactions->sortByDesc('happened_on');

            $period->transactions = $sortedTransactions->values();

            // Disclaimer: I have no idea why you need to assign the result of ->sortByDesc() to another variable, and
            // then retrieve the sorted collection through ->values(), but this was the only way I could get it to work.
        }

        return view('transactions.index', [
            'periods' => $periods
        ]);
    }

    public function create()
    {
        $tags = [];

        foreach (Tag::ofSpace(session('space_id'))->get() as $tag) {
            $tags[] = [
                'key' => $tag->id,
                'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: #' . $tag->color . ';"></div></div><div class="row__column row__column--middle">' . $tag->name . '</div></div>' // phpcs:ignore
            ];
        }

        return view('transactions.create', [
            'tags' => $tags,
            'currencies' => $this->currencyRepository->getIfConversionRatePresent(),
            'defaultCurrencyId' => Space::find(session('space_id'))->currency_id,
            'recurringsIntervals' => $this->recurringRepository->getSupportedIntervals()
        ]);
    }
}
