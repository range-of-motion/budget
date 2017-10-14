@extends('layout')

@section('body')
    <h1>Reports</h1>
    <p class="spacing-top-small spacing-bottom-large">Your monthly reports summarizing budgets, earnings and spendings</p>
    <div class="box">
        <table>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td>
                            <a href="/reports/{{ $budget->year }}/{{ $budget->month }}">@lang('months.' . $budget->month), {{ $budget->year }}<a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
