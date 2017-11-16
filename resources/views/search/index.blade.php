@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column align-middle">
                        <span class="color-dark">Search</span>
                    </div>
                    <div class="column">
                        <form method="GET">
                            <div class="row gutter">
                                <div class="column">
                                    <input class="tight" type="text" name="query" />
                                </div>
                                <div class="column tight">
                                    <button>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (!is_null($query) && !count($earnings) && !count($spendings))
                <div class="section">There were no earnings/spendings found with that search query</div>
            @endif
            @if (count($earnings))
                <ul class="section">
                    @foreach ($earnings as $earning)
                        <li>
                            <div class="row">
                                <div class="column">
                                    <p class="spacing-bottom-small">{{ $earning->description }}</p>
                                    <p>{{ date('jS', strtotime($earning->date)) }}</p>
                                </div>
                                <div class="column text-align-right align-middle">
                                    <h3>{{ $currency->symbol }} {{ $earning->amount }}</h3>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            @if (count($spendings))
                <ul class="section">
                    @foreach ($spendings as $spending)
                        <li>
                            <div class="row">
                                <div class="column">
                                    <p class="spacing-bottom-small">{{ $spending->description }}</p>
                                    <p>{{ $spending->tag->name }} &middot; {{ date('F jS, Y', strtotime($spending->date)) }}</p>
                                </div>
                                <div class="column text-align-right align-middle">
                                    <h3>{{ $currency->symbol }} {{ $spending->amount }}</h3>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
