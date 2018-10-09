@extends('layout')

@section('title', 'Dashboard')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('general.dashboard') }}</h2>
        <div class="row row--gutter row--responsive my-3">
            <div class="row__column">
                <div class="box">
                    <div class="box__section box__section--header">{{ __('general.recent') }} {{ __('general.earnings') }}</div>
                    @if (count($recentEarnings))
                        @foreach ($recentEarnings as $earning)
                            <div class="box__section row row--seperate">
                                <div class="row__column">
                                    <div class="color-dark">{{ $earning->description }}</div>
                                    <div class="mt-1" style="font-size: 14px;">{{ $earning->formatted_happened_on }}</div>
                                </div>
                                <div class="row__column row__column--compact row__column--middle color-dark">{!! $currency !!} {{ $earning->formatted_amount }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="box__section">You don't have any earnings</div>
                    @endif
                </div>
            </div>
            <div class="row__column">
                <div class="box">
                    <div class="box__section box__section--header">{{ __('general.recent') }} {{ __('general.spendings') }}</div>
                    @if (count($recentSpendings))
                        @foreach ($recentSpendings as $spending)
                            <div class="box__section row row--seperate">
                                <div class="row__column">
                                    <div class="color-dark">{{ $spending->description }}</div>
                                    <div class="mt-1" style="font-size: 14px;">{{ $spending->formatted_happened_on }}</div>
                                </div>
                                <div class="row__column row__column--compact row__column--middle color-dark">{!! $currency !!} {{ $spending->formatted_amount }}</div>
                            </div>
                        @endforeach
                    @else
                        <div class="box__section">You don't have any spendings</div>
                    @endif
                </div>
            </div>
        </div>
        <p>{{ __('calendar.months.' . $month) }} {{ date('Y') }}</p>
        <div class="row row--gutter row--responsive my-3">
            <div class="row__column">
                <div class="card card--green">
                    <h2 style="font-size: 20px;">{!! $currency !!} {{ number_format($totalEarnings / 100, 2) }}</h2>
                    <div class="mt-1" style="color: #A7AEBB;">{{ __('general.total_earned') }}</div>
                </div>
            </div>
            <div class="row__column">
                <div class="card card--red">
                    <h2 style="font-size: 20px;">{!! $currency !!} {{ number_format($totalSpendings / 100, 2) }}</h2>
                    <div class="mt-1" style="color: #A7AEBB;">{{ __('general.total_spent') }}</div>
                </div>
            </div>
            <div class="row__column">
                <!-- OFFSET -->
            </div>
        </div>
        <div class="box mb-3">
            <div class="box__section box__section--header">Most Expensive {{ __('general.tags') }}</div>
            @if (count($mostExpensiveTags))
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
            @else
                <div class="box__section">Not enough data</div>
            @endif
        </div>
        <div class="row row--gutter row--responsive">
            <div class="row__column">
                <div class="box">
                    <div class="box__section text-center" style="padding: 15px;">
                        <a href="/earnings">{{ __('general.earnings') }} ({{ $earningsCount }}) <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row__column">
                <div class="box">
                    <div class="box__section text-center" style="padding: 15px;">
                        <a href="/spendings">{{ __('general.spendings') }} ({{ $spendingsCount }}) <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
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
