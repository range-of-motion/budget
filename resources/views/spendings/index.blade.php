@extends('layout')

@section('body')
    <h1>Spendings</h1>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($spendings as $spending)
                    <tr>
                        <td>{{ date('F jS, Y', strtotime($spending->date)) }}</td>
                        <td>{{ $currency->symbol }} {{ $spending->amount }}</td>
                        <td>{{ $spending->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
