@extends('layout')

@section('body')
    <h1>Budgets</h1>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td>@lang('months.' . $budget->month), {{ $budget->year }}</td>
                        <td>{{ $currency }} {{ $budget->amount }}</td>
                        <td>{{ $budget->tag->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
