@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div class="box">
            <div class="box__section">
                <h3>Tags &middot; Edit</h3>
            </div>
            <div class="box__section">
                <form method="POST" action="/tags/{{ $tag->id }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $tag->name }}" />
                    <button class="button">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
