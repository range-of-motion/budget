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
    <div class="row spacing-top-large">
        <div class="column">
            <h2 class="spacing-bottom-medium">Earnings</h2>
            <ul class="box">
                @foreach ($earnings as $earning)
                    <li>
                        <div class="row">
                            <div class="column">
                                <a href="#">{{ $earning->description }}</a>
                                <p class="spacing-top-nano">{{ date('jS', strtotime($earning->date)) }}</p>
                            </div>
                            <div class="column align-right align-middle">
                                <h3 class="color-green">{{ $currency->symbol }} {{ $earning->amount }}</h3>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="column">
            <h2 class="spacing-bottom-medium">Spendings</h2>
            <ul class="box">
                @foreach ($spendings as $spending)
                    <li>
                        <div class="row">
                            <div class="column">
                                <a href="#">{{ $spending->description }}</a>
                                <p class="spacing-top-nano">{{ $spending->tag->name }} &middot; {{ date('jS', strtotime($spending->date)) }}</p>
                            </div>
                            <div class="column align-right align-middle">
                                <h3 class="color-red">{{ $currency->symbol }} {{ $spending->amount }}</h3>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
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
