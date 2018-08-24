@extends('layout')

@section('body')
    <div class="wrapper narrow spacing-top-large spacing-bottom-large">
        <h2 class="text-center spacing-bottom-large">Register</h2>
        <div class="box">
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" />
                        @include('partials.validation_error', ['payload' => 'name'])
                    </div>
                    <div class="input">
                        <label>E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" />
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
                                <option value="{{ $currency->id }}" {{ old('currency') == $currency->id ? 'selected' : '' }}>{{ $currency->symbol }} &middot; {{ $currency->name }}</option>
                            @endforeach
                        </select>
                        @include('partials.validation_error', ['payload' => 'currency'])
                    </div>
                    <button>Register</button>
                </form>
            </div>
        </div>
        <div class="spacing-top-small text-center">
            <a href="/login">Already on Budget?</a>
        </div>
    </div>
@endsection
