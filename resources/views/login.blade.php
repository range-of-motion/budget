@extends('layout')

@section('body')
    <div class="wrapper wrapper--narrow my-4">
        <h2 class="text-center mb-4">Log in</h2>
        @if (session('alert_type') && session('alert_message'))
            @include('partials.alerts.' . session('alert_type'), ['payload' => ['classes' => 'mb-2', 'message' => session('alert_message')]])
        @endif
        <div class="box">
            <div class="box__section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="input">
                        <label>Password</label>
                        <input type="password" name="password" />
                    </div>
                    <button class="button">Log in</button>
                </form>
            </div>
            <div class="box__section box__section--highlight text-center">
                <a href="/register">New to Budget?</a>
            </div>
        </div>
    </div>
@endsection
