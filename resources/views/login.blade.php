@extends('layout')

@section('title', __('auth.login'))

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <h2 class="text-center mb-3">{{ __('auth.login') }}</h2>
        @if (session('alert_type') && session('alert_message'))
            @include('partials.alerts.' . session('alert_type'), ['payload' => ['classes' => 'mb-2', 'message' => session('alert_message')]])
        @endif
        <div class="box">
            <div class="box__section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>{{ __('fields.email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="input">
                        <label>{{ __('fields.password') }}</label>
                        <input type="password" name="password" />
                    </div>
                    <div class="row row--separate" style="justify-content: space-between;">
                        <div class="row__column row__column--compact">
                            <button class="button">{{ __('auth.login') }}</button>
                        </div>
                        <div class="row__column row__column--compact row__column--middle">
                            <a href="/reset_password">{{ __('auth.forgot_password') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-2">
            <a class="fs-sm" href="/register">{{ __('auth.new_to_budget') }}</a>
        </div>
    </div>
@endsection
