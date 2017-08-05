@extends('layout')

@section('body')
    <h1>Report for @lang('months.' . $month), {{ $year }}</h1>
    <div class="box spacing-bottom-large">
        <div class="box__section">
            <p>Budgets</p>
        </div>
        <table class="box__section">
            <tbody>
                @foreach (App\Budget::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->get() as $budget)
                    <tr>
                        <td>{{ $budget->tag->name }}</td>
                        <td>{{ Auth::user()->currency->symbol }} {{ App\Spending::where('user_id', Auth::user()->id)->whereMonth('date', $month)->whereYear('date', $year)->where('tag_id', $budget->tag->id)->sum('amount') }} of {{ Auth::user()->currency->symbol }} {{ $budget->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
