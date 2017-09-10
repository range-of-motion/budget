@extends('layout')

@section('body')
    <h1>Dashboard</h1>
    <div class="row spacing-top-large spacing-bottom-medium">
        <div class="column align-middle">
            <h2>Earnings</h2>
        </div>
        <div class="column align-right">
            <a href="/earnings/create" class="button">Create</a>
        </div>
    </div>
    <div class="box">
        <table>
            <tbody>
                @foreach (Auth::user()->earnings as $earning)
                    <tr>
                        <td>{{ $earning->description }}</td>
                        <td>{{ $currency->symbol }} {{ $earning->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row spacing-top-large spacing-bottom-medium">
        <div class="column align-middle">
            <h2>Spendings</h2>
        </div>
        <div class="column align-right">
            <a href="/spendings/create" class="button">Create</a>
        </div>
    </div>
    <div class="box">
        <table>
            <tbody>
                @foreach (Auth::user()->spendings as $spending)
                    <tr>
                        <td>{{ $spending->description }}</td>
                        <td>{{ $currency->symbol }} {{ $spending->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
