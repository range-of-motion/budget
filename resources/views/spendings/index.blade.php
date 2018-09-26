@extends('layout')

@section('title', __('general.spendings'))

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
                                @include('partials.tag', ['payload' => $spending->tag])
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
