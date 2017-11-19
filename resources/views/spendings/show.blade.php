@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column">
                        <h3>Spending</h3>
                    </div>
                    <div class="column text-align-right align-middle">
                        <a href="/dashboard/{{ date('Y', strtotime($spending->date)) }}/{{ date('n', strtotime($spending->date)) }}">Go back to @lang('months.' . date('n', strtotime($spending->date))) {{ date('Y', strtotime($spending->date)) }}</a>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row gutter">
                    <div class="column">
                        <p class="spacing-bottom-small">Description</p>
                        <h3>{{ $spending->description }}</h3>
                    </div>
                    <div class="column">
                        <p class="spacing-bottom-small">Tag</p>
                        <h3>{{ $spending->tag->name }}</h3>
                    </div>
                    <div class="column">
                        <p class="spacing-bottom-small">Date</p>
                        <h3>{{ date('F jS, Y', strtotime($spending->date)) }}</h3>
                    </div>
                    <div class="column">
                        <p class="spacing-bottom-small">Amount</p>
                        <h3>{{ $currency->symbol }} {{ $spending->amount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
