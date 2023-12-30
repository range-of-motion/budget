<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use App\Models\Recurring;
use App\Jobs\ProcessRecurrings;
use App\Models\Tag;
use App\Repositories\RecurringRepository;

class RecurringController extends Controller
{
    private $recurringRepository;

    public function __construct(RecurringRepository $recurringRepository)
    {
        $this->recurringRepository = $recurringRepository;
    }

    public function index()
    {
        $recurrings = Recurring::query()
            ->where('space_id', session('space_id'))
            ->latest()
            ->get();

        return view('recurrings.index', ['recurrings' => $recurrings]);
    }

    public function show(Recurring $recurring)
    {
        $this->authorize('view', $recurring);

        return view('recurrings.show', compact('recurring'));
    }

    public function create()
    {
        $tags = [];

        foreach (Tag::query()->where('space_id', session('space_id'))->get() as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => $tag->name];
        }

        return view('recurrings.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->recurringRepository->getValidationRules());

        $recurring = $this->recurringRepository->create(
            session('space_id'),
            $request->type,
            $request->interval,
            (int) ltrim($request->input('day'), 0),
            $request->start,
            $request->input('end', null),
            $request->input('tag', null),
            $request->input('description'),
            Helper::rawNumberToInteger($request->input('amount')),
            $request->currency_id
        );

        ProcessRecurrings::dispatch();

        return redirect()->route('recurrings.show', ['recurring' => $recurring->id]);
    }
}
