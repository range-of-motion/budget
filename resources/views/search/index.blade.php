@extends('layout')

@section('body')
    <h1>Search</h1>
    <form method="GET" class="tight">
        <div class="row spacing-top-large">
            <div class="column">
                <input type="text" name="query" />
            </div>
            <div class="column">
                <input type="submit" value="Search" />
            </div>
        </div>
    </form>
    @if (!empty($query))
        @if (sizeof($earnings))
            <h2 class="spacing-top-large spacing-bottom-medium">Earnings</h2>
            <table class="box">
                <thead>
                    <tr>
                        <th>Description</th>
                    </tr>
                </thread>
                <tbody>
                    @foreach ($earnings as $earning)
                        <tr>
                            <td>{{ $earning->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if (sizeof($spendings))
            <h2 class="spacing-top-large spacing-bottom-medium">Spendings</h2>
            <table class="box">
                <thead>
                    <tr>
                        <th>Description</th>
                    </tr>
                </thread>
                <tbody>
                    @foreach ($spendings as $spending)
                        <tr>
                            <td>{{ $spending->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
@endsection
