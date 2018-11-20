@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.profile') }}</h2>
@endsection

@section('settings_body')
    <div class="box">
        <div class="box__section">
            <div class="input input--small">
                <label>{{ __('fields.avatar') }}</label>
                <img src="{{ Auth::user()->avatar }}" style="width: 200px; height: 200px; border-radius: 5px; object-fit: cover;" />
                <input type="file" name="avatar" />
                @include('partials.validation_error', ['payload' => 'avatar'])
            </div>
            <div class="input input--small">
                <label>@lang('fields.name')</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" />
            </div>
            <button class="button">{{ __('actions.save') }}</button>
        </div>
    </div>
@endsection
