@extends('layout')

@section('title', __('models.transactions'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('models.transactions') }}</h2>
        <div class="row mt-1">
            <div class="row__column row__column--compact row__column--compact">Filter by Tag: </div>
            <div class="row__column row__column--compact ml-1">
                <a href="/transactions">None</a>
            </div>
            @foreach ($tags as $tag)
                <div class="row__column row__column--compact ml-1">
                    <a href="/transactions?filterBy=tag-{{ $tag->id }}">{{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
        @foreach ($yearMonths as $key => $transactions)
            <h2 class="mt-3 mb-2">{{ $key }}</h2>
            <div class="box">
                @foreach ($transactions as $transaction)
                    <div class="box__section row">
                        <div class="row__column">{{ $transaction->description }}</div>
                        <div class="row__column">
                            @if ($transaction->tag)
                                @include('partials.tag', ['payload' => $transaction->tag])
                            @endif
                        </div>
                        <div class="row__column {{ get_class($transaction) == 'App\Earning' ? 'color-green' : 'color-red' }}">{!! $currency !!} {{ $transaction->formatted_amount }}</div>
                        <div class="row__column text-right">{{ $transaction->happened_on }}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
