@extends('layout')

@section('title', __('general.earnings'))

@section('body')
    <div class="wrapper my-3">
        <div class="row">
            <div class="row__column row__column--middle">
                <h2>{{ __('general.earnings') }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/earnings/create" class="button">Create Earning</a>
            </div>
        </div>
        <div class="box mt-3">
            @if (count($earnings))
                @foreach ($earnings as $earning)
                    <div class="box__section row">
                        <div class="row__column">
                            <div class="color-dark">{{ $earning->description }}</div>
                            <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $earning->formatted_happened_on }}</div>
                        </div>
                        <div class="row__column row__column--middle color-dark">{!! $currency !!} {{ $earning->formatted_amount }}</div>
                        <div class="row__column row__column--middle row__column--compact">
                            <form method="POST" action="/earnings/{{ $earning->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button link">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="box__section text-center">You don't have any earnings</div>
            @endif
        </div>
    </div>
@endsection
