@extends('layout')

@section('body')
    <h1>Earnings</h1>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($earnings as $earning)
                    <tr>
                        <td>{{ date('F jS, Y', strtotime($earning->date)) }}</td>
                        <td>{{ $currency->symbol }} {{ $earning->amount }}</td>
                        <td>{{ $earning->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
