@extends('layout')

@section('body')
    <div class="banner">
        <h1>Reports for {{ $currentYear }}</h1>
    </div>
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="row gutter">
            <div class="column">
                <div class="box">
                    <div class="section">
                        <canvas id="earningsSpendingsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <div class="section">
                        <canvas id="tagsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var context = document.getElementById('earningsSpendingsChart').getContext('2d');

        var chart = new Chart(context, {
            type: 'line',

            data: {
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],

                datasets: [
                    {
                        label: 'Earnings',
                        data: {!! json_encode($monthlyEarnings) !!},
                        borderColor: 'rgba(151, 206, 86, 1)',
                        backgroundColor: 'rgba(151, 206, 86, .1)'
                    }, {
                        label: 'Spendings',
                        data: {!! json_encode($monthlySpendings) !!},
                        borderColor: 'rgba(255, 95, 94, 1)',
                        backgroundColor: 'rgba(255, 95, 94, .1)'
                    }
                ]
            },

            options: {
                animation: {
                    duration: 0
                },

                elements: {
                    line: {
                        tension: .2
                    }
                }
            }
        });

        var context2 = document.getElementById('tagsChart').getContext('2d');

        var chart2 = new Chart(context2, {
            type: 'pie',

            data: {
                labels: {!! json_encode($tl) !!},

                datasets: [{
                    backgroundColor: {!! json_encode($tc) !!},
                    data: {!! json_encode($td) !!}
                }]
            },

            options: {
                animation: {
                    duration: 0
                }
            }
        });
    </script>
@endsection
