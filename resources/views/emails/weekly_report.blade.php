@extends('emails.template')

@section('content')
    Here's your weekly report for {{ $space->name }}.

    This week (#{{ $week }}) you've
    <ul>
        <li>Spent CURRENCY {{ number_format($totalSpent / 100, 2) }}</li>
        @if (count($largestSpendingWithTag))
            <li>Most of which you've spent on {{ $largestSpendingWithTag[0]->tag_name }} (CURRENCY {{ number_format($largestSpendingWithTag[0]->amount / 100, 2) }})</li>
        @endif
    </ul>

    If you don't want to receive a weekly report, head over to <a href="{{ config('app.url') . '/settings' }}">settings</a> and let us know.
@endsection
