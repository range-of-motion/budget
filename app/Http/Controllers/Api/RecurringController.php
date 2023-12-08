<?php

namespace App\Http\Controllers\Api;

use App\Enums\RecurringInterval;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessRecurrings;
use App\Models\Recurring;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecurringController extends Controller
{
    public function store(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $space = $apiKey->user->spaces()->first();

        $request->validate([
            'type' => ['required', 'in:earning,spending'],
            'interval' => ['required', Rule::enum(RecurringInterval::class)],
            'day' => ['required', 'regex:/\b(0?[1-9]|[12][0-9]|3[01])\b/'],
            'start' => ['date', 'date_format:Y-m-d'],
            'end' => ['nullable', 'date', 'date_format:Y-m-d'],
            'tag_id' => ['nullable', 'exists:tags,id'], // TODO: CHECK IF TAG BELONGS TO USER
            'description' => ['required', 'max:255'],
            'amount' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
        ]);

        Recurring::create([
            'space_id' => $space->id,
            'type' => $request->input('type'),
            'interval' => $request->input('interval'),
            'day' => (int) ltrim($request->input('day'), 0),
            'starts_on' => $request->input('start'),
            'ends_on' => $request->input('end'),
            'tag_id' => $request->input('tag_id'),
            'description' => $request->input('description'),
            'amount' => (int) ($request->input('amount') * 100),
            'currency_id' => $space->currency_id,
        ]);

        ProcessRecurrings::dispatch();

        return [];
    }
}
