@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div class="box">
            <div class="box__section">
                <h3>Tags &middot; Create</h3>
            </div>
            <div class="box__section">
                <form method="POST" action="/tags">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" />
                    <button class="button">@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
