@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column">
                        <h3>Earning</h3>
                    </div>
                    <div class="column text-align-right align-middle">
                        <a href="/dashboard/{{ date('Y', strtotime($earning->date)) }}/{{ date('n', strtotime($earning->date)) }}">Go back to @lang('months.' . date('n', strtotime($earning->date))) {{ date('Y', strtotime($earning->date)) }}</a>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row gutter">
                    <div class="column">
                        <p class="spacing-bottom-small">Description</p>
                        <h3>{{ $earning->description }}</h3>
                    </div>
                    <div class="column">
                        <p class="spacing-bottom-small">Date</p>
                        <h3>{{ date('F jS, Y', strtotime($earning->date)) }}</h3>
                    </div>
                    <div class="column">
                        <p class="spacing-bottom-small">Amount</p>
                        <h3>{{ $currency->symbol }} {{ $earning->amount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
