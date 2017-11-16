@extends('layout')

@section('body')
    <div class="wrapper narrow spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Register</h3>
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
                    <div class="row gutter">
                        <div class="column tight">
                            <button>Register</button>
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
