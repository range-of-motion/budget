@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div style="color: black; margin-bottom: 20px;">{{ __('general.earnings') }}</div>
        <div class="box">
            @if (count($earnings))
                @foreach ($earnings as $earning)
                    <div class="section row">
                        <div class="row__column">
                            <div>{{ $earning->description }}</div>
                            <div style="margin-top: 10px; font-size: 14px;">{{ $earning->formatted_happened_on }}</div>
                        </div>
                        <div class="row__column text-right" style="color: green;">&euro; {{ $earning->formatted_amount }}</div>
                    </div>
                @endforeach
            @else
                <div class="section text-center">You don't have any earnings</div>
            @endif
        </div>
    </div>
@endsection
