@extends('layout')

@section('body')
    <div class="row">
        <div class="column align-middle">
            <h1>Budgets</h1>
        </div>
        <div class="column align-right">
            <a href="/budgets/create" class="button">Create</a>
        </div>
    </div>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr>
                        <td>@lang('months.' . $budget->month), {{ $budget->year }}</td>
                        <td>{{ $currency }} {{ $budget->amount }}</td>
                        <td>{{ $budget->tag->name }}</td>
                        <td>
                            <form class="test" method="POST" action="/budgets/{{ $budget->id }}">
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
