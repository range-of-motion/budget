@extends('layout')

@section('body')
    <h1>Tags PLACEHOLDER Create</h1>
    <div class="box spacing-small spacing-top-large">
        <form method="POST" action="/tags">
            {{ csrf_field() }}
            <label>Name</label>
            <input type="text" name="name" />
            <input type="submit" value="Create" />
        </form>
    </div>
@endsection
