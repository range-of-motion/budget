@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Tags &middot; Create</h3>
            </div>
            <div class="section">
                <form method="POST" action="/tags">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" />
                    <button>@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
