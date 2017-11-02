@extends('layout')

@section('body')
    <h1 class="spacing-bottom-medium">{{ $earning->description }}</h1>
    <form method="POST" action="/earnings/{{ $earning->id }}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="submit" value="Delete" />
    </form>
@endsection
