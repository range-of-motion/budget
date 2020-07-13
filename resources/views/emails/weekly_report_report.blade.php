Here's your weekly report for {{ $space->name }}.

This week (#{{ $week }}) you've
- Spent {!! $space->currency->symbol !!} {{ \App\Helper::formatNumber($totalSpent / 100) }}
@if (count($largestSpendingWithTag))- Most of which you've spent on {{ $largestSpendingWithTag[0]->tag_name }} ({!! $space->currency->symbol !!} {{ \App\Helper::formatNumber($largestSpendingWithTag[0]->amount / 100) }})@endif

Tired of these reports? Use the link below to change your preferences.

{{ config('app.url') . '/settings/preferences' }}
