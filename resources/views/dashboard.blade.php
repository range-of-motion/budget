@extends('layout')

@section('title', 'Dashboard')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div style="color: black; margin-bottom: 20px;">{{ __('months.' . $month) }}</div>
        <div class="box mb-4">
            <div class="box__section row">
                <div class="row__column text-center">
                    <div class="mb-1" style="margin-bottom: 10px; color: #A7AEBB;">Total Spent</div>
                    <h2>{{ $currency->symbol }} {{ number_format($totalSpendings / 100, 2) }}</h2>
                </div>
                <div class="row__column text-center">
                    <div class="mb-1" style="margin-bottom: 10px; color: #A7AEBB;">Most Expensive Tag</div>
                    <h2>{{ count($mostExpensiveTag) ? $mostExpensiveTag[0]->name : '-' }}</h2>
                </div>
                <div class="row__column text-center">
                    <div class="mb-1" style="margin-bottom: 10px; color: #A7AEBB;">Most Expensive Day</div>
                    <h2>{{ count($mostExpensiveWeekday) ? __('weekdays.' . $mostExpensiveWeekday[0]->weekday) : '-' }}</h2>
                </div>
            </div>
            <div class="box__section">
                <div class="ct-chart ct-perfect-fifth" style="max-width: 500px; margin-left: auto; margin-right: auto;"></div>
            </div>
        </div>
        <div class="row gutter spacing-bottom-large">
            <div class="column">
                <div class="box">
                    <div class="box__section text-center" style="padding: 15px;">
                        <a href="/earnings">Earnings ({{ $earningsCount }}) <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <div class="box__section text-center" style="padding: 15px;">
                        <a href="/spendings">Spendings ({{ $spendingsCount }}) <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var labels = [{!! implode(',', array_map(function ($entry) { return '\'' . $entry->name . '\''; }, $tagsBreakdown)) !!}];

        var data = {
            series: [{!! implode(',', array_map(function ($entry) { return $entry->amount; }, $tagsBreakdown)) !!}]
        };

        var sum = function(a, b) { return a + b };

        new Chartist.Pie('.ct-chart', data, {
            donut: true,
            donutWidth: 10,
            donutSolid: true,
            startAngle: 270,
            showLabel: true,

            labelInterpolationFnc: function (value, x) {
                return labels[x] + ' (' + Math.round(value / data.series.reduce(sum) * 100) + '%)';
            }
        });
    </script>
@endsection
