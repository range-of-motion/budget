@extends('layout')

@section('body')
    <div class="row spacing-bottom-large">
        <div class="column">
            <h1>{{ $spending->description }}</h1>
        </div>
        <div class="column">
            <div class="box">
                <table>
                    <tbody>
                        <tr>
                            <th>Date</th>
                            <td>{{ date('F jS, Y', strtotime($spending->date)) }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ $currency->symbol }} {{ $spending->amount }}</td>
                        </tr>
                        <tr>
                            <th>Tag</th>
                            <td>{{ $spending->tag->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
