@extends('layout')

@section('title', __('models.earnings'))

@section('body')
    <div class="wrapper my-3">
        <div class="row">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.earnings') }} - {{ now()->year }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/transactions/create" class="button">{{ __('actions.create') }} {{ __('models.earning') }}</a>
            </div>
        </div>
        @if (session('restorableEarning'))
            <div class="mt-3">{{ __('messages.successfully_deleted', ['resource' => __('models.earning')]) }}</div>
            <form method="POST" action="/earnings/{{ session('restorableEarning') }}/restore" class="mt-05">
                {{ csrf_field() }}
                <button class="button link">{{ __('messages.still_able_to_recover') }}</button>
            </form>
        @endif
        @if (count($earningsByMonth))
            @foreach ($earningsByMonth as $index => $earnings)
                @if (count($earnings))
                    <h3 class="mt-3 mb-2">{{ __('calendar.months.' . $index) }}</h3>
                    <div class="box">
                        @foreach ($earnings as $earning)
                            <div class="box__section row">
                                <div class="row__column">
                                    <div class="color-dark">{{ $earning->description }}</div>
                                    <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $earning->formatted_happened_on }}</div>
                                </div>
                                <div class="row__column row__column--middle">
                                    @if ($earning->tag)
                                        @include('partials.tag', ['payload' => $earning->tag])
                                    @endif
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
                    </div>
                @endif
            @endforeach
        @else
            <div class="box mt-3">
                @include('partials.empty_state', ['payload' => 'earnings'])
            </div>
        @endif
    </div>
@endsection
