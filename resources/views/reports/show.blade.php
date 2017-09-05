@extends('layout')

@section('body')
    <h1 class="spacing-bottom-large">Report for @lang('months.' . $month), {{ $year }}</h1>
    <div class="row">
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-green spacing-bottom-small">{{ $currency }} {{ $earnings }}</h1>
                <p>Earnings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-red spacing-bottom-small">{{ $currency }} {{ $spendings }}</h1>
                <p>Spendings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-blue spacing-bottom-small">{{ $currency }} {{ $earnings - $spendings }}</h1>
                <p>Balance</p>
            </div>
        </div>
    </div>
    <h2 class="spacing-top-large spacing-bottom-medium">Budgets</h2>
    <div class="box">
        <table>
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
