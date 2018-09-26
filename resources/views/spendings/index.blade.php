@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('general.spendings') }}</h2>
        <div class="box mt-3">
            @if (count($spendings))
                @foreach ($spendings as $spending)
                    <div class="box__section row">
                        <div class="row__column">
                            <div class="color-dark">{{ $spending->description }}</div>
                            <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $spending->formatted_happened_on }}</div>
                        </div>
                        <div class="row__column row__column--middle">
                            @if ($spending->tag)
                                <div style="
                                    display: inline-block;
                                    padding: 5px 10px;
                                    text-transform: uppercase;
                                    font-size: 12px;
                                    font-weight: bolder;
                                    bolder; color: #FFF;
                                    background: #333;
                                    border-radius: 5px;
                                ">{{ $spending->tag->name }}</div>
                            @endif
                        </div>
                        <div class="row__column row__column--middle text-right" style="color: red;">&euro; {{ $spending->formatted_amount }}</div>
                    </div>
                @endforeach
            @else
                <div class="box__section text-center">You don't have any spendings</div>
            @endif
        </div>
    </div>
@endsection
