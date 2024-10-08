<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Tag;
use App\Repositories\BudgetRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BudgetController extends Controller
{
    public function __construct(private readonly BudgetRepository $budgetRepository, private readonly TagRepository $tagRepository)
    {
    }

    public function index()
    {
        return view('budgets.index', [
            'budgets' => $this->budgetRepository->getActive()
        ]);
    }

    public function create()
    {
        $tags = Tag::query()
            ->where('space_id', session('space_id'))
            ->latest()
            ->get();

        return view('budgets.create', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $request->validate($this->budgetRepository->getValidationRules());

        $user = Auth::user();
        $tag = $this->tagRepository->getById($request->tag_id);

        if (!$user->can('view', $tag)) {
            throw ValidationException::withMessages(['tag_id' => __('validation.forbidden')]);
        }

        if ($this->budgetRepository->doesExist(session('space_id'), $request->tag_id)) {
            return redirect()
                ->route('budgets.create')
                ->with('message', 'A budget like this already exists');
        }

        $amount = Helper::rawNumberToInteger($request->amount);
        $this->budgetRepository->create(session('space_id'), $request->tag_id, $request->period, $amount);

        return redirect()->route('budgets.index');
    }
}
