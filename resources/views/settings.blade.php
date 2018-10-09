@extends('layout')

@section('title', 'Settings')

@section('body')
    <div class="wrapper my-3">
        <h2>Settings</h2>
        <div class="box mt-3">
            <form method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box__section row">
                    <div class="row__column">Profile</div>
                    <div class="row__column" style="flex: 2;">
                        <div class="input input--small">
                            <label>{{ __('general.avatar') }}</label>
                            @if (Auth::user()->avatar)
                                <img src="/storage/avatars/{{ Auth::user()->avatar }}" style="width: 200px; height: 200px; border-radius: 5px; object-fit: cover;" />
                            @else
                                <div>You don't have an avatar</div>
                            @endif
                            <input type="file" name="avatar" />
                            @include('partials.validation_error', ['payload' => 'avatar'])
                        </div>
                        <div class="input input--small">
                            <label>{{ __('general.name') }}</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" />
                        </div>
                    </div>
                </div>
                <div class="box__section row">
                    <div class="row__column">Account</div>
                    <div class="row__column" style="flex: 2;">
                        <div class="input input--small">
                            <label>{{ __('general.email') }}</label>
                            <input type="text" name="email" value="{{ Auth::user()->email }}" />
                        </div>
                        <div class="row">
                            <div class="row__column input">
                                <label>{{ __('general.password') }}</label>
                                <input type="password" name="password" />
                                @include('partials.validation_error', ['payload' => 'password'])
                            </div>
                            <div class="row__column input ml-2">
                                <label>{{ __('general.verify') }} {{ __('general.password') }}</label>
                                <input type="password" name="password_confirmation" />
                                @include('partials.validation_error', ['payload' => 'password_confirmation'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box__section row">
                    <div class="row__column">Preferences</div>
                    <div class="row__column" style="flex: 2;">
                        <div class="input input--small">
                            <label>{{ __('general.language') }}</label>
                            <select name="language">
                                @foreach ($languages as $key => $value)
                                    <option value="{{ $key }}" @if (Auth::user()->language === $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @include('partials.validation_error', ['payload' => 'language'])
                        </div>
                        <div class="input input--small">
                            <label>{{ __('general.theme') }}</label>
                            <select name="theme">
                                <option value="light" {{ Auth::user()->theme == 'light' ? 'selected' : '' }}>Light</option>
                                <option value="dark" {{ Auth::user()->theme == 'dark' ? 'selected' : '' }}>Dark (Experimental)</option>
                            </select>
                            @include('partials.validation_error', ['payload' => 'theme'])
                        </div>
                        <div class="input input--small mb-0">
                            <label>Weekly Report</label>
                            <div>
                                <input type="radio" name="weekly_report" value="true" {{ Auth::user()->weekly_report ? 'checked' : '' }} /> Yes
                            </div>
                            <div>
                                <input type="radio" name="weekly_report" value="false" {{ Auth::user()->weekly_report ? '' : 'checked' }} /> No
                            </div>
                            @include('partials.validation_error', ['payload' => 'weekly_report'])
                        </div>
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
