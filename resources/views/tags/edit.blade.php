@extends('layout')

@section('body')
    <h1>Tags &middot; Edit</h1>
    <div class="box spacing-small spacing-top-large">
        <form method="POST" action="/tags/{{ $tag->id }}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <label>Name</label>
            <input type="text" name="name" value="{{ $tag->name }}" />
            <input type="submit" value="Edit" />
        </form>
    </div>
@endsection
