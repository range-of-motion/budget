@extends('layout')

@section('title', __('actions.create') . ' ' . __('models.earning'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.create') }} {{ __('models.earning') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/earnings" autocomplete="off">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>{{ __('fields.date') }}</label>
                        <DatePicker></DatePicker>
                        @include('partials.validation_error', ['payload' => 'date'])
                    </div>
                    <div class="input input--small">
                        <label>{{ __('fields.description') }}</label>
                        <input type="text" name="description" />
                        @include('partials.validation_error', ['payload' => 'description'])
                    </div>
                    <div class="input input--small mb-0">
                        <label>{{ __('fields.amount') }}</label>
                        <input type="text" name="amount" />
                        @include('partials.validation_error', ['payload' => 'amount'])
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">@lang('actions.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
