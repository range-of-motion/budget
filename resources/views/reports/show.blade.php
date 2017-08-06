@extends('layout')

@section('body')
    <h1>Report for @lang('months.' . $month), {{ $year }}</h1>
    <div class="row spacing-bottom-large">
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">@include('partials.currency') {{ App\Earning::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->sum('amount') }}</h2>
                    <p>Earned</p>
                </div>
            </div>
        </div>
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">@include('partials.currency') {{ App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->sum('amount') }}</h2>
                    <p>Spent</p>
                </div>
            </div>
        </div>
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">@include('partials.currency') {{ App\Earning::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->sum('amount') - App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->sum('amount') }}</h2>
                    <p>Net</p>
                </div>
            </div>
        </div>
    </div>
    <div class="box spacing-bottom-large">
        <div class="box__section">
            <p>Alerts</p>
        </div>
        <table class="box__section">
            <tbody>
                @foreach (App\Budget::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->get() as $budget)
                    @if (App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->where('tag_id', $budget->tag->id)->sum('amount') > $budget->amount)
                        <tr>
                            <td>Exceeded budget for '{{ $budget->tag->name }}' by @include('partials.currency') {{ App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->where('tag_id', $budget->tag->id)->sum('amount') - $budget->amount }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box spacing-bottom-large">
        <div class="box__section">
            <p>Budgets</p>
        </div>
        <table class="box__section">
            <tbody>
                @foreach (App\Budget::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->get() as $budget)
                    <tr>
                        <td>{{ $budget->tag->name }}</td>
                        <td>@include('partials.currency') {{ App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->where('tag_id', $budget->tag->id)->sum('amount') }} of @include('partials.currency') {{ $budget->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
