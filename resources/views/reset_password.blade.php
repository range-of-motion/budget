@extends('layout')

@section('title', 'Reset Password')

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <div class="text-center">
            <img src="/logo.svg" style="width: 100%; max-height: 50px;" />
            <h2 class="mt-2 mb-3">Reset Password</h2>
        </div>
        <div class="box">
            <div class="box__section">
                <form method="POST">
                    {{ csrf_field() }}
                    @if ($token)
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <div class="input">
                            <label>Password</label>
                            <input type="password" name="password" class="shadow" />
                        </div>
                        <div class="input">
                            <label>Verify Password</label>
                            <input type="password" name="password_confirmation" class="shadow" />
                        </div>
                    @else
                        <div class="input">
                            <label>E-mail</label>
                            <input type="email" name="email" class="shadow" />
                        </div>
                    @endif
                    <button class="button button--wide">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
