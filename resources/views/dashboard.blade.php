@extends('layout')

@section('body')
    <div class="banner">
        <div class="row gutter">
            <div class="column tight align-middle">
                <a href="/dashboard/{{ $previousYear }}/{{ $previousMonth }}">
                    <i class="fa fa-angle-left" style="font-size: 24px;"></i>
                </a>
            </div>
            <div class="column tight align-middle">
                <h1>@lang('months.' . $month), {{ $year }}</h1>
            </div>
            <div class="column tight align-middle">
                <a href="/dashboard/{{ $nextYear }}/{{ $nextMonth }}">
                    <i class="fa fa-angle-right" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box spacing-bottom-large">
            <div class="section">
                <h3>Spendings by Tag</h3>
                <ul class="t st-3">
                    @foreach ($spendingsByTag as $tag)
                        <li class="row">
                            <div class="column">
                                {{ $tag->name }}
                            </div>
                            <div class="column tight sl-1">
                                {{ $currency->symbol }} {{ $tag->spendings }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row gutter spacing-bottom-large">
            <div class="column">
                <div class="box">
                    <div class="section">
                        <p class="spacing-bottom-small">@lang('general.earnings')</p>
                        <h1>{{ $currency->symbol }} {{ $totalEarnings }}</h1>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <div class="section">
                        <p class="spacing-bottom-small">@lang('general.spendings')</p>
                        <h1>{{ $currency->symbol }} {{ $totalSpendings }}</h1>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <div class="section">
                        <p class="spacing-bottom-small">@lang('general.balance')</p>
                        <h1>{{ $currency->symbol }} {{ $balance }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column">
                        <span class="color-dark">@lang('general.budgets')</span>
                    </div>
                    <div class="column align-middle text-align-right">
                        <a href="/budgets/create">@lang('actions.create')</a>
                    </div>
                </div>
            </div>
            @if ($budgets->count())
                <ul class="section">
                    @foreach ($budgets as $budget)
                        <li>
                            <div class="row">
                                <div class="column">{{ $budget->tag->name }}</div>
                                <div class="column align-middle">
                                    <progress min="0" max="{{ $budget->amount }}" value="{{ $budget->spendings()->sum('amount') }}"></progress>
                                </div>
                                <div class="column text-align-right align-middle">{{ $currency->symbol }} {{ $budget->spendings()->sum('amount') }} @lang('general.of') {{ $currency->symbol }} {{ $budget->amount }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="section">You don't have any budgets</div>
            @endif
        </div>
        <div class="row gutter spacing-top-large">
            <div class="column">
                <div class="box">
                    <div class="section">
                        <div class="row">
                            <div class="column">
                                <span class="color-dark">@lang('general.earnings')</span>
                            </div>
                            <div class="column align-middle text-align-right">
                                <a href="/earnings/create">@lang('actions.create')</a>
                            </div>
                        </div>
                    </div>
                    @if ($earnings->count())
                        <ul class="section">
                            @foreach ($earnings as $earning)
                                <li>
                                    <div class="row">
                                        <div class="column">
                                            <a href="/earnings/{{ $earning->id }}">{{ $earning->description }}</a>
                                            <p class="spacing-top-small">{{ date('jS', strtotime($earning->date)) }}</p>
                                        </div>
                                        <div class="column text-align-right align-middle">
                                            <h3>{{ $currency->symbol }} {{ $earning->amount }}</h3>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="section">You don't have any earnings</div>
                    @endif
                </div>
            </div>
            <div class="column">
                <div class="box">
                    <div class="section">
                        <div class="row">
                            <div class="column">
                                <span class="color-dark">@lang('general.spendings')</span>
                            </div>
                            <div class="column align-middle text-align-right">
                                <a href="/spendings/create">@lang('actions.create')</a>
                            </div>
                        </div>
                    </div>
                    @if ($spendings->count())
                        <div class="section">
                            <BarChart slices='{!! json_encode($spendingsByTags) !!}'></BarChart>
                        </div>
                        <ul class="section">
                            @foreach ($spendings as $spending)
                                <li>
                                    <div class="row">
                                        <div class="column">
                                            <a href="/spendings/{{ $spending->id }}">{{ $spending->description }}</a>
                                            @if ($spending->tag)
                                                <p class="spacing-top-small">{{ $spending->tag->name }} &middot; {{ date('jS', strtotime($spending->date)) }}</p>
                                            @else
                                                <p class="spacing-top-small">{{ date('jS', strtotime($spending->date)) }}</p>
                                            @endif
                                        </div>
                                        <div class="column text-align-right align-middle">
                                            <h3>{{ $currency->symbol }} {{ $spending->amount }}</h3>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="section">You don't have any spendings</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
