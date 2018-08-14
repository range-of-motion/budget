@extends('layout')

@section('body')
    <div class="wrapper narrow spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column ">
                        <span class="color-dark">Log in</span>
                    </div>
                    <div class="column align-middle text-align-right">
                        <a href="/register">Register</a>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="input">
                        <label>E-mail</label>
                        <input type="email" name="email" />
                    </div>
                    <div class="input">
                        <label>Password</label>
                        <input type="password" name="password" />
                    </div>
                    <button>Log in</button>
                </form>
            </div>
        </div>
    </div>
@endsection
