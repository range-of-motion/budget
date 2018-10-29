@extends('layout')

@section('title', __('pages.settings'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('pages.settings') }}</h2>
        <div class="box mt-3">
            <form method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box__section row">
                    <div class="row__column">{{ __('general.profile') }}</div>
                    <div class="row__column" style="flex: 2;">
                        <div class="input input--small">
                            <label>{{ __('fields.avatar') }}</label>
                            @if (Auth::user()->avatar)
                                <img src="/storage/avatars/{{ Auth::user()->avatar }}" style="width: 200px; height: 200px; border-radius: 5px; object-fit: cover;" />
                            @else
                                <div>You don't have an avatar</div>
                            @endif
                            <input type="file" name="avatar" />
                            @include('partials.validation_error', ['payload' => 'avatar'])
                        </div>
                        <div class="input input--small">
                            <label>@lang('fields.name')</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" />
                        </div>
                    </div>
                </div>
                <div class="box__section row">
                    <div class="row__column">{{ __('general.account') }}</div>
                    <div class="row__column" style="flex: 2;">
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
                    </div>
                </div>
                <div class="box__section row">
                    <div class="row__column">{{ __('general.preferences') }}</div>
                    <div class="row__column" style="flex: 2;">
                        <div class="input input--small">
                            <label>{{ __('fields.language') }}</label>
                            <select name="language">
                                @foreach ($languages as $key => $value)
                                    <option value="{{ $key }}" @if (Auth::user()->language === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
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
                            <label>{{ __('fields.currency') }}</label>
                            <select name="currency">
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}" {{ Auth::user()->currency_id == $currency->id ? 'selected' : '' }}>{!! $currency->symbol !!} &middot; {{ $currency->name }}</option>
                                @endforeach
                            </select>
                            @include('partials.validation_error', ['payload' => 'currency'])
                        </div>
                        <div class="input input--small mb-0">
                            <label>{{ __('fields.weekly_report') }}</label>
                            <div>
                                <input type="radio" name="weekly_report" value="true" {{ Auth::user()->weekly_report ? 'checked' : '' }} /> {{ __('actions.yes') }}
                            </div>
                            <div>
                                <input type="radio" name="weekly_report" value="false" {{ Auth::user()->weekly_report ? '' : 'checked' }} /> {{ __('actions.no') }}
                            </div>
                            @include('partials.validation_error', ['payload' => 'weekly_report'])
                        </div>
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">{{ __('actions.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
