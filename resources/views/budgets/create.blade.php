@extends('layout')

@section('body')
    <h1>Budgets &middot; Create</h1>
    <div class="box spacing-small spacing-top-large">
        <form method="POST" action="/budgets">
            {{ csrf_field() }}
            <label>Tag</label>
            <select name="tag">
                <option>-</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <div class="row">
                <div class="column">
                    <label>Year</label>
                    <input type="text" name="year" />
                </div>
                <div class="column">
                    <label>Month</label>
                    <select name="month">
                        <option>-</option>
                        @for ($month = 1; $month <= 12; $month ++)
                            <option value="{{ $month }}">@lang('months.' . $month)</option>
                        @endfor
                    </select>
                </div>
            </div>
            <label>Amount</label>
            <input type="text" name="amount" />
            <input type="submit" value="Create" />
        </form>
    </div>
@endsection
