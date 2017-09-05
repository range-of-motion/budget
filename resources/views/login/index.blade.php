@extends('layout')

@section('body')
    <h1 class="spacing-bottom-large">Log in</h1>
    <div class="box spacing-small">
        <form method="POST">
            {{ csrf_field() }}
            <label>E-mail</label>
            <input type="email" name="email" />
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" value="Log in" />
        </form>
    </div>
@endsection
