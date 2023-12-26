<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Space;
use App\Models\Tag;
use App\Repositories\RecurringRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $recurringRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        RecurringRepository $recurringRepository
    ) {
        $this->repository = $transactionRepository;
        $this->recurringRepository = $recurringRepository;
    }

    public function index(Request $request)
    {
        $filterBy = [];

        if ($request->get('filterBy')) {
            $filterBy = explode('-', $request->get('filterBy'));
        }

        return view('transactions.index', [
            'yearMonths' => $this->repository->getTransactionsByYearMonth($filterBy),
            'tags' => Tag::ofSpace(session('space_id'))->get()
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

        $spaceCurrencyId = Space::find(session('space_id'))->currency_id;

        $currencies = Currency::select('currencies.*')
            ->leftJoin('conversion_rates AS cr', 'cr.base_currency_id', '=', 'currencies.id')
            ->where('cr.target_currency_id', $spaceCurrencyId)
            ->orWhere('currencies.id', $spaceCurrencyId)
            ->groupBy('currencies.id')
            ->get();

        return view('transactions.create', [
            'tags' => $tags,
            'currencies' => $currencies,
            'defaultTransactionType' => Auth::user()->default_transaction_type,
            'firstDayOfWeek' => Auth::user()->first_day_of_week,
            'defaultCurrencyId' => Space::find(session('space_id'))->currency_id,
            'recurringsIntervals' => $this->recurringRepository->getSupportedIntervals()
        ]);
    }
}
