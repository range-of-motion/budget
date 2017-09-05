@extends('layout')

@section('body')
    <h1>Dashboard</h1>
    <h2 class="spacing-top-large spacing-bottom-medium">Earnings</h2>
    <div class="box">
        <table>
            <tbody>
                @foreach (Auth::user()->earnings as $earning)
                    <tr>
                        <td>{{ $earning->description }}</td>
                        <td>@include('partials.currency') {{ $earning->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h2 class="spacing-top-large spacing-bottom-medium">Spendings</h2>
    <div class="box">
        <table>
            <tbody>
                @foreach (Auth::user()->spendings as $spending)
                    <tr>
                        <td>{{ $spending->description }}</td>
                        <td>@include('partials.currency') {{ $spending->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
