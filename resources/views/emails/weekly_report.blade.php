@extends('emails.template')

@section('content')
    Here's your weekly report for {{ $space->name }}.

    This week (#{{ $week }}) you've
    <ul>
        <li>Spent {!! $space->currency->symbol !!} {{ number_format($totalSpent / 100, 2) }}</li>
        @if (count($largestSpendingWithTag))
            <li>Most of which you've spent on {{ $largestSpendingWithTag[0]->tag_name }} ({!! $space->currency->symbol !!} {{ number_format($largestSpendingWithTag[0]->amount / 100, 2) }})</li>
        @endif
    </ul>

    Tired of these reports? <a href="{{ config('app.url') . '/settings/preferences' }}">Change your preferences</a>.
@endsection
