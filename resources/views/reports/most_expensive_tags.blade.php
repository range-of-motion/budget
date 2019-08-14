@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>Most Expensive Tags</h2>
        <div class="box mt-3">
            @if (count($mostExpensiveTags))
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
            @else
                @include('partials.empty_state', ['payload' => 'most_expensive_tags', 'action' => 'false'])
            @endif
        </div>
    </div>
@endsection
