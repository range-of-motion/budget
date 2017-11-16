@extends('layout')

@section('body')
    <div class="wrapper narrow spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Log in</h3>
            </div>
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>E-mail</label>
                    <input type="email" name="email" />
                    <label>Password</label>
                    <input type="password" name="password" />
                    <div class="row gutter">
                        <div class="column tight">
                            <button>Log in</button>
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
