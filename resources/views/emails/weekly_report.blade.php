@extends('emails.template')

@section('title', __('emails.weekly_report.title') . ' ' . $space->name)

@section('message')
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        {{ __('emails.weekly_report.this_week') }} (#{{ $week }}) {{ __('emails.weekly_report.you_have') }}
        <ul>
            <li>{{ __('emails.weekly_report.spent') }} {!! $space->currency->symbol !!} {{ number_format($totalSpent / 100, 2) }}</li>
            @if (count($largestSpendingWithTag))
                <li>{{ __('emails.weekly_report.most_spent') }} {{ $largestSpendingWithTag[0]->tag_name }} ({!! $space->currency->symbol !!} {{ number_format($largestSpendingWithTag[0]->amount / 100, 2) }})</li>
            @endif
        </ul>
@endsection

@section('button')
    {{ __('emails.weekly_report.tired_of_reports') }}
    <a href="{{ config('app.url') . '/settings/preferences' }}" class="button button-blue" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097d1; border-top: 10px solid #3097d1; border-right: 18px solid #3097d1; border-bottom: 10px solid #3097d1; border-left: 18px solid #3097d1;">
        {{ __('emails.weekly_report.button') }}
    </a>
@endsection
