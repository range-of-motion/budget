@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Budgets &middot; Create</h3>
            </div>
            <div class="section">
                <form method="POST" action="/budgets">
                    {{ csrf_field() }}
                    <label>Tag</label>
                    <select name="tag">
                        <option>-</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <div class="row gutter">
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
                    <button>Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
