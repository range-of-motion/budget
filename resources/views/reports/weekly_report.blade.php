@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>Weekly Report {{ $year }}</h2>
        <div class="box mt-3">
            <div class="box__section">
                <div class="ct-chart ct-major-twelfth"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var data = {
            labels: [{!! implode(',', array_keys($weeks)) !!}],
            series: [[{!! '"' . implode('","', $weeks) . '"' !!}]]
        };

        new Chartist.Line('.ct-chart', data, {
            showPoint: false,
            lineSmooth: false
        });
    </script>
@endsection
