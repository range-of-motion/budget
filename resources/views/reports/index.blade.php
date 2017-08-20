@extends('layout')

@section('body')
    <h1>Reports</h1>
    <div class="box">
        <table class="box__section">
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
