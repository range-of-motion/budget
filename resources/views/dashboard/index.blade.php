@extends('layout')

@section('body')
    <h1>Dashboard</h1>
    <h2 class="spacing-top-large spacing-bottom-medium">@lang('months.' . $month)</h2>
    <div class="row">
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-green spacing-bottom-small">{{ $currency->symbol }} {{ $earnings }}</h1>
                <p>Earnings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-red spacing-bottom-small">{{ $currency->symbol }} {{ $spendings }}</h1>
                <p>Spendings</p>
            </div>
        </div>
        <div class="column">
            <div class="box spacing-large">
                <h1 class="color-blue spacing-bottom-small">{{ $currency->symbol }} {{ $earnings - $spendings }}</h1>
                <p>Balance</p>
            </div>
        </div>
    </div>
@endsection
