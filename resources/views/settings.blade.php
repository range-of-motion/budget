@extends('layout')

@section('body')
    <h1>Settings</h1>
    <div class="box">
        <div class="box__section">
            <form method="POST">
                {{ csrf_field() }}
                <label>Name</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" />
                <label>E-mail</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" />
                <input type="submit" value="Update" />
            </form>
        </div>
    </div>
@endsection
