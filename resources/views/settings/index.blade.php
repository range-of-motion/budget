@extends('layout')

@section('body')
    <h1 class="spacing-bottom-large">Settings</h1>
    <div class="box spacing-small">
        <form method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="column">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" />
                </div>
                <div class="column">
                    <label>E-mail</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" />
                </div>
            </div>
            <input type="submit" value="Update" />
        </form>
    </div>
@endsection
