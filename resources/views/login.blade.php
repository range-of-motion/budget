@extends('layout')

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <h2 class="text-center mb-3">Log in</h2>
        @if (session('alert_type') && session('alert_message'))
            @include('partials.alerts.' . session('alert_type'), ['payload' => ['classes' => 'mb-2', 'message' => session('alert_message')]])
        @endif
        <div class="box">
            <div class="box__section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="shadow" />
                    </div>
                    <div class="input">
                        <label>Password</label>
                        <input type="password" name="password" class="shadow" />
                    </div>
                    <button class="button button--wide">Log in</button>
                    <div class="mt-2 text-right">
                        <a href="/reset_password" class="fs-sm">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-2">
            <a class="fs-sm" href="/register">New to Budget?</a>
        </div>
    </div>
@endsection
