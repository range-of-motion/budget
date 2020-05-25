@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>Most Expensive Tags</h2>
        @if (count($mostExpensiveTags))
            <div class="box mt-3">
                @foreach ($mostExpensiveTags as $index => $tag)
                    <div class="box__section row row--seperate">
                        <div class="row__column row__column--middle color-dark">
                            @include('partials.tag', ['payload' => $tag])
                        </div>
                        <div class="row__column row__column--middle">
                            <progress max="{{ $totalSpent }}" value="{{ $tag->amount }}"></progress>
                        </div>
                        <div class="row__column row__column--middle text-right">{!! $currency !!} {{ \App\Helper::formatNumber($tag->amount / 100) }} / {!! $currency !!} {{ \App\Helper::formatNumber($totalSpent / 100) }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
