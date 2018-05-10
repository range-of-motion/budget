@extends('layout')

@section('title', 'Dashboard')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="row gutter spacing-bottom-large">
            <div class="column">
                <div class="color-dark spacing-bottom-large">Recent Earnings</div>
                <div class="box">
                    @if (count($recentEarnings))
                        <ul class="box__section">
                            @foreach ($recentEarnings as $earning)
                                <li>
                                    <div class="row">
                                        <div class="column">
                                            <div class="color-dark">{{ $earning->description }}</div>
                                            <div style="margin-top: 10px;">{{ intval((time() - strtotime($earning->date)) / 86400) }} day(s) ago</div>
                                        </div>
                                        <div class="column text-align-right align-middle color-green">{{ $currency->symbol }} {{ $earning->amount }}</h3></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="box__section">You don't have any earnings</div>
                    @endif
                    <div class="box__section">
                        <a href="/earnings">Show More</a>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="color-dark spacing-bottom-large">Recent Spendings</div>
                <div class="box">
                    @if (count($recentSpendings))
                        <ul class="box__section">
                            @foreach ($recentSpendings as $spending)
                                <li>
                                    <div class="row">
                                        <div class="column">
                                            <div class="color-dark">{{ $spending->description }}</div>
                                            <div style="margin-top: 10px;">{{ intval((time() - strtotime($spending->date)) / 86400) }} day(s) ago</div>
                                        </div>
                                        <div class="column text-align-right align-middle color-red">{{ $currency->symbol }} {{ $spending->amount }}</h3></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="box__section">You don't have any spendings</div>
                    @endif
                    <div class="box__section">
                        <a href="/spendings">Show More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
