@extends('layout')

@section('body')
    <h1>Search</h1>
    <form method="GET">
        <div class="row spacing-top-large spacing-bottom-large">
            <div class="column">
                <input type="text" name="query" />
            </div>
            <div class="column">
                <input type="submit" value="Search" />
            </div>
        </div>
    </form>
    @if (!empty($query))
        <table class="box">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thread>
            <tbody>
                @foreach ($earnings as $earning)
                    <tr>
                        <td>Earning</td>
                        <td>{{ $earning->description }}</td>
                    </tr>
                @endforeach
                @foreach ($spendings as $spending)
                    <tr>
                        <td>Spending</td>
                        <td>{{ $spending->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
