@extends('layout')

@section('title', __('models.earnings'))

@section('body')
    <div class="wrapper my-3">
        <div class="row">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.earnings') }}</h2>
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
        <div class="box mt-3">
            @if (count($earnings))
                @foreach ($earnings as $earning)
                    <div class="box__section row">
                        <div class="row__column">
                            <div class="color-dark">{{ $earning->description }}</div>
                        </div>
                        <div class="row__column row__column--middle color-dark">{!! $currency !!} {{ $earning->formatted_amount }}</div>
                        <div class="row__column row__column--middle row row--right">
                            <div class="row__column row__column--compact">
                                <a href="/earnings/{{ $earning->id }}/edit">
                                    <i class="far fa-pencil"></i>
                                </a>
                                    <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $earning->formatted_happened_on }}</div>
                            </div>
                            <div class="row__column row__column--compact ml-2">
                                <form method="POST" action="/earnings/{{ $earning->id }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="button link">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @include('partials.empty_state', ['payload' => 'earnings'])
            @endif
        </div>
    </div>
@endsection
