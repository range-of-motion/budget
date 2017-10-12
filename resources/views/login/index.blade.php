@extends('layout')

@section('body')
    <div class="row">
        <div class="column size-560 align-center">
            @if ($errors->any())
                <div class="alert spacing-bottom-large">{{ $errors->first() }}</div>
            @endif
            <h1 class="spacing-bottom-large">Log in</h1>
            <div class="box spacing-small">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>E-mail</label>
                    <input type="email" name="email" />
                    <label>Password</label>
                    <input type="password" name="password" />
                    <div class="row tight">
                        <div class="column">
                            <input type="submit" value="Log in" />
                        </div>
                        <div class="column align-middle">
                            <a href="/register">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
