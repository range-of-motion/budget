<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\Tag;
use App\Repositories\CurrencyRepository;
use App\Repositories\RecurringRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $filterBy = [];

        if ($request->get('filterBy')) {
            $filterBy = explode('-', $request->get('filterBy'));
        }

        return view('transactions.index', [
            'yearMonths' => $this->repository->getTransactionsByYearMonth($filterBy),
            'tags' => Tag::query()->where('space_id', session('space_id'))->get(),
        ]);
    }

    public function create()
    {
        $tags = [];

        foreach (Tag::query()->where('space_id', session('space_id'))->get() as $tag) {
            $tags[] = [
                'key' => $tag->id,
                'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: #' . $tag->color . ';"></div></div><div class="row__column row__column--middle">' . $tag->name . '</div></div>' // phpcs:ignore
            ];
        }

        return view('transactions.create', [
            'tags' => $tags,
            'currencies' => $this->currencyRepository->getIfConversionRatePresent(),
            'defaultTransactionType' => Auth::user()->default_transaction_type,
            'firstDayOfWeek' => Auth::user()->first_day_of_week,
            'defaultCurrencyId' => Space::find(session('space_id'))->currency_id,
            'recurringsIntervals' => $this->recurringRepository->getSupportedIntervals()
        ]);
    }
}
