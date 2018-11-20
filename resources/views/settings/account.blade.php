@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.account') }}</h2>
@endsection

@section('settings_body')
    <div class="box">
        <div class="box__section">
            <div class="input input--small">
                <label>{{ __('fields.email') }}</label>
                <input type="text" name="email" value="{{ Auth::user()->email }}" />
            </div>
            <div class="row">
                <div class="row__column input">
                    <label>{{ __('fields.password') }}</label>
                    <input type="password" name="password" />
                    @include('partials.validation_error', ['payload' => 'password'])
                </div>
                <div class="row__column input ml-2">
                    <label>{{ __('actions.verify') }} {{ __('fields.password') }}</label>
                    <input type="password" name="password_confirmation" />
                    @include('partials.validation_error', ['payload' => 'password_confirmation'])
                </div>
            </div>
            <button class="button">{{ __('actions.save') }}</button>
        </div>
    </div>
@endsection
