<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use App\Repositories\TagRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $transactionRepository;
    private $tagRepository;

    public function __construct(TransactionRepository $transactionRepository, TagRepository $tagRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        return view('reports.index');
    }

    private function weeklyReport($year)
    {
        return view('reports.weekly_report', [
            'year' => $year,
            'weeks' => $this->transactionRepository->getWeeklyBalance($year)
        ]);
    }

    private function mostExpensiveTags()
    {
        $totalSpent = Spending::query()->where('space_id', session('space_id'))->sum('amount');
        $mostExpensiveTags = $this->tagRepository->getMostExpensiveTags(session('space_id'));

        return view('reports.most_expensive_tags', compact('totalSpent', 'mostExpensiveTags'));
    }

    public function show(Request $request, $slug)
    {
        switch ($slug) {
            case 'weekly-report':
                $year = date('Y');

                if ($request->get('year')) {
                    $year = $request->get('year');
                }

                return $this->weeklyReport($year);

            case 'most-expensive-tags':
                return $this->mostExpensiveTags();

            default:
                return '404';
        }
    }
}
