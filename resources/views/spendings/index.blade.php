@extends('layout')

@section('title', __('models.spendings'))

@section('body')
    <div class="wrapper my-3">
        <div class="row">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.spendings') }} - {{ now()->year }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/transactions/create" class="button">{{ __('actions.create') }} {{ __('models.spending') }}</a>
            </div>
        </div>
        @if (session('restorableSpending'))
            <div class="mt-3">{{ __('messages.successfully_deleted', ['resource' => __('models.spending')]) }}</div>
            <form method="POST" action="/spendings/{{ session('restorableSpending') }}/restore" class="mt-05">
                {{ csrf_field() }}
                <button class="button link">{{ __('messages.still_able_to_recover') }}</button>
            </form>
        @endif
        @if (count($spendingsByMonth))
            @foreach ($spendingsByMonth as $index => $spendings)
                @if (count($spendings))
                    <h3 class="mt-3 mb-2">{{ __('calendar.months.' . $index) }}</h3>
                    <div class="box">
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
                                <div class="row__column row__column--middle color-dark">{!! $currency !!} {{ $spending->formatted_amount }}</div>
                                <div class="row__column row__column--middle row__column--compact">
                                    <form method="POST" action="/spendings/{{ $spending->id }}">
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
                @include('partials.empty_state', ['payload' => 'spendings'])
            </div>
        @endif
    </div>
@endsection
