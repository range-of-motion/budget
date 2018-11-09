@extends('layout')

@section('title', 'Dashboard')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('general.dashboard') }}</h2>
        <p class="mt-1">{{ __('calendar.months.' . $month) }} {{ date('Y') }}</p>
        <div class="row row--gutter row--responsive my-3">
            <div class="row__column">
                <div class="card card--blue">
                    <h2 style="font-size: 20px;">{!! $currency !!} {{ number_format($balance / 100, 2) }}</h2>
                    <div class="mt-1" style="color: #A7AEBB;">{{ __('general.balance') }}</div>
                </div>
            </div>
            <div class="row__column">
                <div class="card card--red">
                    <h2 style="font-size: 20px;">{!! $currency !!} {{ number_format($recurrings / 100, 2) }}</h2>
                    <div class="mt-1" style="color: #A7AEBB;">{{ __('general.recurrings') }}</div>
                </div>
            </div>
            <div class="row__column">
                <div class="card card--green">
                    <h2 style="font-size: 20px;">{!! $currency !!} {{ number_format($leftToSpend / 100, 2) }}</h2>
                    <div class="mt-1" style="color: #A7AEBB;">{{ __('general.left_to_spend') }}</div>
                </div>
            </div>
        </div>
        @if (count($mostExpensiveTags))
            <div class="box mb-3">
                <div class="box__section box__section--header">Most Expensive {{ __('models.tags') }}</div>
                    @foreach ($mostExpensiveTags as $index => $tag)
                        <div class="box__section row row--seperate">
                            <div class="row__column row__column--compact mr-2" style="width: 50px;">
                                <div class="ct-chart-{{ $index }} ct-square"></div>
                            </div>
                            <div class="row__column row__column--middle">
                                <div class="color-dark">{{ $tag->name }}</div>
                                <div class="mt-1" style="font-size: 14px; font-weight: 600;">{!! $currency !!} {{ number_format($tag->amount / 100, 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        @foreach ($mostExpensiveTags as $index => $tag)
            var data = {
                series: [{{ $tag->amount }}, {{ $totalSpendings - $tag->amount }}]
            };

            new Chartist.Pie('.ct-chart-{{ $index }}', data, {
                donut: true,
                donutWidth: 2,
                donutSolid: true,
                showLabel: false
            });
        @endforeach
    </script>
@endsection
