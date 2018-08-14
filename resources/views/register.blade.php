@extends('layout')

@section('body')
    <div class="wrapper narrow spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column ">
                        <span class="color-dark">Register</span>
                    </div>
                    <div class="column align-middle text-align-right">
                        <a href="/login">Log in</a>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>Name</label>
                        <input type="text" name="name" />
                        @include('partials.validation_error', ['payload' => 'name'])
                    </div>
                    <div class="input">
                        <label>E-mail</label>
                        <input type="email" name="email" />
                        @include('partials.validation_error', ['payload' => 'email'])
                    </div>
                    <div class="input">
                        <label>Password</label>
                        <input type="password" name="password" />
                        @include('partials.validation_error', ['payload' => 'password'])
                    </div>
                    <div class="input">
                        <label>Verify Password</label>
                        <input type="password" name="password_confirmation" />
                        @include('partials.validation_error', ['payload' => 'password_confirmation'])
                    </div>
                    <div class="input">
                        <label>Currency</label>
                        <select name="currency">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->symbol }} &middot; {{ $currency->name }}</option>
                            @endforeach
                        </select>
                        @include('partials.validation_error', ['payload' => 'currency'])
                    </div>
                    <button>Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
