@extends('layout')

@section('body')
    <h1>Report for @lang('months.' . $month), {{ $year }}</h1>
    <div class="row spacing-bottom-large">
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">{{ $currency }} {{ $earnings }}</h2>
                    <p>Earned</p>
                </div>
            </div>
        </div>
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">{{ $currency }} {{ $spendings }}</h2>
                    <p>Spent</p>
                </div>
            </div>
        </div>
        <div class="row__column">
            <div class="box">
                <div class="box__section box__section--align-center">
                    <h2 class="spacing-bottom-small">{{ $currency }} {{ $earnings - $spendings }}</h2>
                    <p>Net</p>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box__section">
            <p>Budgets</p>
        </div>
        <table class="box__section">
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td>{{ $budget->tag->name }}</td>
                        <td>{{ $currency }} {{ $budget->spendings()->sum('amount') }} of {{ $currency }} {{ $budget->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
