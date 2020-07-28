@extends('layout')

@section('title', 'Dashboard')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('general.dashboard') }}</h2>
        <p class="mt-1">{{ __('calendar.months.' . $month) }} {{ date('Y') }}</p>
        <div class="row row--gutter row--responsive my-3">
            @foreach ($widgets as $widget)
                <div class="row__column">
                    {!! $widget->render() !!}
                </div>
            @endforeach
        </div>
        @if (count($mostExpensiveTags))
            <div class="box mt-3">
                <div class="box__section box__section--header">Most Expensive {{ __('models.tags') }}</div>
                @foreach ($mostExpensiveTags as $index => $tag)
                    <div class="box__section row row--seperate">
                        <div class="row__column row__column--middle color-dark">
                            @include('partials.tag', ['payload' => $tag])
                        </div>
                        <div class="row__column row__column--middle">
                            <progress max="{{ $totalSpent }}" value="{{ $tag->amount }}"></progress>
                        </div>
                        <div class="row__column row__column--middle text-right">{!! $currency !!} {{ \App\Helper::formatNumber($tag->amount / 100) }}</div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="box mt-3">
            <div class="box__section box__section--header">Daily Balance</div>
            <div class="box__section">
                <div class="ct-chart ct-major-twelfth"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new Chartist.Line('.ct-chart', {
            labels: [{!! implode(',', range(1, $daysInMonth)) !!}],
            series: [[{!! implode(',', $dailyBalance) !!}]]
        }, {
            showPoint: false,
            lineSmooth: false,

            axisX: {
                showGrid: false
            },

            axisY: {
                labelInterpolationFnc: function (value) {
                    return value.toFixed(2);
                }
            }
        });
    </script>
@endsection
