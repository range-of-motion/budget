<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use App\Models\Recurring;
use Auth;
use App\Jobs\ProcessRecurrings;
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
        return view('recurrings.index', [
            'recurrings' => session('space')->recurrings()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function show(Recurring $recurring)
    {
        $this->authorize('view', $recurring);

        return view('recurrings.show', compact('recurring'));
    }

    public function create()
    {
        $tags = [];

        foreach (session('space')->tags as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => $tag->name];
        }

        return view('recurrings.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->recurringRepository->getValidationRules());

        $recurring = $this->recurringRepository->create(
            session('space')->id,
            $request->type,
            'monthly',
            (int) ltrim($request->input('day'), 0),
            $request->input('end', null),
            $request->input('tag', null),
            $request->input('description'),
            Helper::rawNumberToInteger($request->input('amount'))
        );

        ProcessRecurrings::dispatch();

        return redirect()->route('recurrings.show', ['recurring' => $recurring->id]);
    }
}
