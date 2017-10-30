@extends('layout')

@section('body')
    <div class="row spacing-bottom-small">
        <div class="column align-middle align-right">
            <a href="/dashboard/{{ $previousYear }}/{{ $previousMonth }}">Previous</a>
        </div>
        <div class="column tight align-middle align-center">
            <h3>@lang('months.' . $month)</h3>
        </div>
        <div class="column align-middle">
            <a href="/dashboard/{{ $nextYear }}/{{ $nextMonth }}">Next</a>
        </div>
    </div>
    <div class="row">
        <div class="column align-middle align-right">
            <a href="/dashboard/{{ $year - 1 }}/{{ $month }}">Previous</a>
        </div>
        <div class="column tight align-middle align-center">
            <h1>{{ $year }}</h1>
        </div>
        <div class="column align-middle">
            <a href="/dashboard/{{ $year + 1 }}/{{ $month }}">Next</a>
        </div>
    </div>
    <div class="row spacing-top-large">
        <div class="column">
            <h2 class="spacing-bottom-medium">Earnings</h2>
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
        </div>
        <div class="column">
            <h2 class="spacing-bottom-medium">Spendings</h2>
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
        </div>
        <div class="column">
            <h2 class="spacing-bottom-medium">Budgets</h2>
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
        </div>
    </div>
@endsection
