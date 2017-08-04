@extends('layout')

@section('body')
    <h1>Dashboard</h1>
    <div class="box spacing-bottom-large">
        <div class="box__section">
            <span style="font-size: 18px;">Earnings</span>
        </div>
        <table class="box__section">
            <tbody>
                @foreach (Auth::user()->earnings as $earning)
                    <tr>
                        <td>{{ $earning->description }}</td>
                        <td>{{ Auth::user()->currency->symbol }} {{ $earning->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box">
        <div class="box__section">
            <span style="font-size: 18px;">Spendings</span>
        </div>
        <table class="box__section">
            <tbody>
                @foreach (Auth::user()->spendings as $spending)
                    <tr>
                        <td>{{ $spending->description }}</td>
                        <td>{{ Auth::user()->currency->symbol }} {{ $spending->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
