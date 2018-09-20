@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('general.earnings') }}</h2>
        <div class="box mt-3">
            @if (count($earnings))
                @foreach ($earnings as $earning)
                    <div class="box__section row">
                        <div class="row__column">
                            <div>{{ $earning->description }}</div>
                            <div style="margin-top: 10px; font-size: 14px;">{{ $earning->formatted_happened_on }}</div>
                        </div>
                        <div class="row__column text-right" style="color: green;">&euro; {{ $earning->formatted_amount }}</div>
                    </div>
                @endforeach
            @else
                <div class="box__section text-center">You don't have any earnings</div>
            @endif
        </div>
    </div>
@endsection
