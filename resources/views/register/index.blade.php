@extends('layout')

@section('body')
    <div class="row">
        <div class="column size-560 align-center">
            <h1 class="spacing-bottom-large">Register</h1>
            <div class="box spacing-small">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" />
                    @if ($errors->has('name'))
                        <div class="alert-inline">{{ $errors->first('name') }}</div>
                    @endif
                    <label>E-mail</label>
                    <input type="email" name="email" />
                    @if ($errors->has('email'))
                        <div class="alert-inline">{{ $errors->first('email') }}</div>
                    @endif
                    <label>Password</label>
                    <input type="password" name="password" />
                    @if ($errors->has('password'))
                        <div class="alert-inline">{{ $errors->first('password') }}</div>
                    @endif
                    <label>Currency</label>
                    <select name="currency">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->symbol }} &middot; {{ $currency->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('currency_id'))
                        <div class="alert-inline">{{ $errors->first('currency_id') }}</div>
                    @endif
                    <div class="row tight">
                        <div class="column">
                            <input type="submit" value="Register" />
                        </div>
                        <div class="column align-middle">
                            <a href="/login">Log in</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
