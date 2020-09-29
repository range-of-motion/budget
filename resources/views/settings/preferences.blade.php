@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.preferences') }}</h2>
@endsection

@section('settings_body')
    <div class="box">
        <div class="box__section">
            <div class="input input--small">
                <label>{{ __('fields.language') }}</label>
                <searchable
                    name="language"
                    :items='@json($languages)'
                    initial="{{ Auth::user()->language }}"></searchable>
                @include('partials.validation_error', ['payload' => 'language'])
            </div>
            <div class="input input--small">
                <label>{{ __('fields.theme') }}</label>
                <select name="theme">
                    <option value="light" {{ Auth::user()->theme == 'light' ? 'selected' : '' }}>Light</option>
                    <option value="dark" {{ Auth::user()->theme == 'dark' ? 'selected' : '' }}>Dark (Experimental)</option>
                </select>
                @include('partials.validation_error', ['payload' => 'theme'])
            </div>
            <div class="input input--small">
                <label>{{ __('fields.weekly_report') }}</label>
                <div>
                    <input type="radio" name="weekly_report" value="true" {{ Auth::user()->weekly_report ? 'checked' : '' }} /> {{ __('actions.yes') }}
                </div>
                <div>
                    <input type="radio" name="weekly_report" value="false" {{ Auth::user()->weekly_report ? '' : 'checked' }} /> {{ __('actions.no') }}
                </div>
                @include('partials.validation_error', ['payload' => 'weekly_report'])
            </div>
            <div class="input input--small">
                <label>{{ __('fields.default_transaction_type') }}</label>
                <div>
                    <input type="radio" name="default_transaction_type" value="earning" {{ Auth::user()->default_transaction_type === 'earning' ? 'checked' : '' }} /> {{ __('models.earning') }}
                </div>
                <div>
                    <input type="radio" name="default_transaction_type" value="spending" {{ Auth::user()->default_transaction_type === 'spending' ? 'checked' : '' }} /> {{ __('models.spending') }}
                </div>
                @include('partials.validation_error', ['payload' => 'default_transaction_type'])
            </div>
            <div class="input input--small">
                <label>{{ __('fields.first_day_of_week') }}</label>
                <div>
                    <input type="radio" name="first_day_of_week" value="sunday" {{ Auth::user()->first_day_of_week === 'sunday' ? 'checked' : '' }} /> {{ __('calendar.weekdays.6') }}
                </div>
                <div>
                    <input type="radio" name="first_day_of_week" value="monday" {{ Auth::user()->first_day_of_week === 'monday' ? 'checked' : '' }} /> {{ __('calendar.weekdays.0') }}
                </div>
                @include('partials.validation_error', ['payload' => 'first_day_of_week'])
            </div>
            <button class="button">{{ __('actions.save') }}</button>
        </div>
    </div>
@endsection
