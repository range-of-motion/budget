@extends('layout')

@section('body')
    <h1>Earnings</h1>
    <div class="box">
        <table class="box__section">
            <tbody>
                @foreach (Auth::user()->earnings as $earning)
                    <tr>
                        <td>{{ $earning->description }}</td>
                        <td>{{ $earning->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h1>Spendings</h1>
    <div class="box">
        <table class="box__section">
            <tbody>
                @foreach (Auth::user()->spendings as $spending)
                    <tr>
                        <td>{{ $spending->description }}</td>
                        <td>{{ $spending->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
