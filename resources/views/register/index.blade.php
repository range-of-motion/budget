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
                    <button>Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
