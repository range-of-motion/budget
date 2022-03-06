@extends('layout')

@section('title', __('auth.reset_password'))

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <div class="text-center">
            <img src="/logo.svg" style="width: 100%; max-height: 50px;" />
            <h2 class="mt-2 mb-3">{{ __('auth.reset_password') }}</h2>
        </div>
        <div class="box">
            <div class="box__section">
                <form method="POST">
                    {{ csrf_field() }}
                    @if ($token)
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <div class="input">
                            <label>{{ __('fields.password') }}</label>
                            <input type="password" name="password" class="shadow" />
                        </div>
                        <div class="input">
                            <label>{{ __('auth.verify_password') }}</label>
                            <input type="password" name="password_confirmation" class="shadow" />
                        </div>
                    @else
                        <div class="input">
                            <label>E-mail</label>
                            <input type="email" name="email" class="shadow" />
                        </div>
                    @endif
                    <button class="button button--wide">{{ __('actions.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
