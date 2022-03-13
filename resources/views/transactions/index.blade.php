@extends('layout')

@section('title', __('models.transactions'))

@section('body')
    <div class="wrapper my-3" id="transactions-page">
        <div class="row mb-3">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.transactions') }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="{{ route('transactions.create') }}" class="button">{{ __('actions.create') }} {{ __('models.transactions') }}</a>
            </div>
        </div>
        <div class="row row--responsive">
            <div class="row__column mr-3" style="max-width: 300px;">
                <div class="box">
                    <div class="box__section">
                        <div class="mb-2">
                            <a href="{{ route('transactions.index') }}">{{ __('actions.reset') }}</a>
                        </div>
                        <span>{{ __('activities.tag.filter') }}</span>
                        @foreach ($tags as $tag)
                            <div class="mt-1 ml-1">
                                <a href="{{ route('transactions.index', [ 'filterBy' => ['tag' => $tag->id], "monthIndex" => $currentMonthIndex]) }}" v-pre>{{ $tag->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row__column">
                <h2 class="mb-2">
                    <a href="{{ route('transactions.index', ['monthIndex' => ($currentMonthIndex - 1) ]) }}"><i class="fa fa-chevron-left"></i></a>
                    {{ __('calendar.months.' . $month) }}, {{ $year }}
                    <a href="{{ route('transactions.index', ['monthIndex' => ($currentMonthIndex + 1) ]) }}"><i class="fa fa-chevron-right"></i></a>
                </h2>
                <ul class="flex flex-wrap border-b border-gray-200 dark:border-gray-700 mb-2" id="transaction-tabs">
                    <li>
                        <a href="#" onclick="changeTab(this, 'list')" aria-current="page" class="transaction-link inline-block py-4 px-4 text-sm font-medium text-center rounded-t-lg active">
                            {{ __('fields.list') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="changeTab(this, 'chart')" class="transaction-link inline-block py-4 px-4 text-sm font-medium text-center rounded-t-lg">
                            {{ __('fields.chart') }}
                        </a>
                    </li>
                </ul>
                @if ($transactions)
                    <div class="box transaction-block" id="transaction-list">
                        @foreach ($transactions as $key => $transaction)
                            <div class="box__section row row--responsive">
                                <div class="row__column row__column--middle row row--middle">
                                    <div v-pre>
                                        {{ $transaction->description }}
                                        <br> <span class="date">{{ $transaction->happened_on->format('d') }} {{ __('calendar.months.' . $month) }}, {{ $year }}</span>
                                    </div>
                                    <a href="{{ route(get_class($transaction) === 'App\Models\Earning' ? 'earnings.show' : 'spendings.show', [ $transaction->id ]) }}">
                                        <i class="fas fa-info-circle fa-xs c-light ml-1"></i>
                                    </a>
                                    <a href="{{ route(get_class($transaction) === 'App\Models\Earning' ? 'earnings.edit' : 'spendings.edit', [ $transaction->id ]) }}">
                                        <i class="fas fa-pencil fa-xs c-light ml-1"></i>
                                    </a>
                                    <form action="{{ route(get_class($transaction) === 'App\Models\Earning' ? 'earnings.delete' : 'spendings.delete', [ $transaction->id ]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="button link">
                                            <i class="fas fa-trash fa-xs c-light ml-1"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="row__column">
                                    @if ($transaction->tag)
                                        <div class="row">
                                            <div class="row__column row__column--compact row__column--middle mr-05" style="font-size: 12px;">
                                                <i class="fas fa-tag" style="color: #{{ $transaction->tag->color }};"></i>
                                            </div>
                                            <div class="row__column row__column--compact row__column--middle" v-pre>{{ $transaction->tag->name }}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row__column row__column--compact w-50">
                                    @if ($transaction->recurring_id)
                                        <i class="fas fa-recycle"></i>
                                    @endif
                                </div>
                                <div class="row__column row__column--compact row__column--middle w-150 row row--middle row--right {{ get_class($transaction) == 'App\Models\Earning' ? 'color-green' : 'color-red' }}">
                                    <div class="row__column row__column--compact">{!! $currency !!} {{ $transaction->formatted_amount }}</div>
                                    <div class="row__column row__column--compact ml-1">
                                        @if (get_class($transaction) == 'App\Models\Earning')
                                            <i class="fas fa-arrow-alt-left fa-sm"></i>
                                        @else
                                            <i class="fas fa-arrow-alt-right fa-sm"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="transaction-block" id="transaction-chart" style="display: none;">
                        <canvas id="transactionsChartBar"></canvas>
                        <canvas id="transactionsChartCircle"></canvas>
                    </div>
                @else
                    <div class="box">
                        @include('partials.empty_state', ['payload' => 'transactions'])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/chartjs.js') }}"></script>
    <script>
        //TODO : change that on vueJs component
        function changeTab(evt, tabName) {
            // Declare all variables
            let i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("transaction-block");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("transaction-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById("transaction-"+tabName).style.display = "block";
            evt.className += " active";
        }

        @if ($transactionsChart)
            let labels = [];
            let transactionsData = [];
            let transactionsColor = [];
            let testDataset = [];
            @foreach($transactionsChart as $label => $content)
                testDataset.push({
                    label: '{{ $label }}',
                    data: ['{{ $content['amount'] }}'],
                    backgroundColor: [ '{{ $content['color'] }}' ],
                })
                labels.push('{{ $label }}');
                transactionsData.push('{{ $content['amount'] }}');
                transactionsColor.push('{{ $content['color'] }}');
            @endforeach

            let label = '{{ __('models.transactions') }}';
            const data = {
                labels: labels,
                datasets: [{
                    label: label,
                    data: transactionsData,
                    backgroundColor: transactionsColor,
                    hoverOffset: 2
                }]
            };

            const barChart = new Chart(
                document.getElementById('transactionsChartBar'),
                {
                    type: 'bar',
                    data: data
                }
            );

            const circleChart = new Chart(
                document.getElementById('transactionsChartCircle'),
                {
                    type: 'doughnut',
                    data: data
                }
            )
        @endif

    </script>
@endsection
