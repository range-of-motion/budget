<?php

namespace App\Http\Controllers;

use App\Repositories\BudgetRepository;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private $budgetRepository;

    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function index()
    {
        return view('budgets.index', [
            'budgets' => $this->budgetRepository->getActive()
        ]);
    }
}
