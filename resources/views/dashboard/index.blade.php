@extends('layout')

@section('body')
    <div class="row">
        <div class="column align-middle">
            <div class="row">
                <div class="column tight align-middle">
                    <a href="/dashboard/{{ $year - 1 }}/{{ $month }}">Previous</a>
                </div>
                <div class="column tight align-middle">
                    <h1>{{ $year }}</h1>
                </div>
                <div class="column tight align-middle">
                    <a href="/dashboard/{{ $year + 1 }}/{{ $month }}">Next</a>
                </div>
            </div>
        </div>
        <div class="column tight align-middle align-right">
            <div class="row">
                <div class="column tight align-middle">
                    <a href="/dashboard/{{ $previousYear }}/{{ $previousMonth }}">Previous</a>
                </div>
                <div class="column tight align-middle">
                    <h2>@lang('months.' . $month)</h2>
                </div>
                <div class="column tight align-middle">
                    <a href="/dashboard/{{ $nextYear }}/{{ $nextMonth }}">Next</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row spacing-top-large">
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-green spacing-bottom-small">{{ $currency->symbol }} {{ $totalEarnings }}</h1>
                <p>Earnings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-red spacing-bottom-small">{{ $currency->symbol }} {{ $totalSpendings }}</h1>
                <p>Spendings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-blue spacing-bottom-small">{{ $currency->symbol }} {{ $balance }}</h1>
                <p>Balance</p>
            </div>
        </div>
    </div>
    <h2 class="spacing-top-large spacing-bottom-medium">Earnings</h2>
    <table class="box spacing-large">
        <tbody>
            @foreach ($earnings as $earning)
                <tr>
                    <td>{{ $earning->description }}</td>
                    <td>{{ $currency->symbol }} {{ $earning->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 class="spacing-top-large spacing-bottom-medium">Spendings</h2>
    <table class="box spacing-large">
        <tbody>
            @foreach ($spendings as $spending)
                <tr>
                    <td>{{ $spending->description }}</td>
                    <td>{{ $currency->symbol }} {{ $spending->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 class="spacing-top-large spacing-bottom-medium">Budgets</h2>
    <table class="box spacing-large">
        <tbody>
            @foreach ($budgets as $budget)
                <tr>
                    <td>{{ $budget->tag->name }}</td>
                    <td>{{ $currency->symbol }} {{ $budget->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
