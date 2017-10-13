@extends('layout')

@section('body')
    <div class="row">
        <div class="column size-560 align-center">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert spacing-bottom-large">{{ $error }}</div>
                @endforeach
            @endif
            <h1 class="spacing-bottom-large">Register</h1>
            <div class="box spacing-small">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" />
                    <label>E-mail</label>
                    <input type="email" name="email" />
                    <label>Password</label>
                    <input type="password" name="password" />
                    <label>Currency</label>
                    <select name="currency">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->symbol }} &middot; {{ $currency->name }}</option>
                        @endforeach
                    </select>
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
