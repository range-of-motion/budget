@extends('layout')

@section('title', __('reports.most_expensive_tags.title'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('reports.most_expensive_tags.title') }}</h2>
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
                        <div class="row__column row__column--middle text-right">{!! $currency !!} {{ number_format($tag->amount / 100, 2) }} / {!! $currency !!} {{ number_format($totalSpent / 100, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            @include('partials.empty_state', ['payload' => 'most_expensive_tags'])
        @endif
    </div>
@endsection
