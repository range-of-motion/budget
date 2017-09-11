@extends('layout')

@section('body')
    <div class="row spacing-bottom-large">
        <div class="column align-middle">
            <h1>Earnings</h1>
        </div>
        <div class="column align-right">
            <a href="/earnings/create" class="button">Create</a>
        </div>
    </div>
    <div class="box">
        <table>
            <tbody>
                @foreach ($earnings as $earning)
                    <tr>
                        <td>{{ date('F jS, Y', strtotime($earning->date)) }}</td>
                        <td>{{ $currency->symbol }} {{ $earning->amount }}</td>
                        <td>{{ $earning->description }}</td>
                        <td>
                            <form class="test" method="POST" action="/earnings/{{ $earning->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
