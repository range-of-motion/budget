@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Settings</h3>
            </div>
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" />
                    <label>E-mail</label>
                    <input type="text" name="email" value="{{ Auth::user()->email }}" />
                    <button>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
