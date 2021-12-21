@extends('layout')

@section('title', $spending->description)

@section('body')
    <div class="wrapper my-3">
        <h2 v-pre>{{ $spending->description }}</h2>
        @include('partials.attachments', ['payload' => $spending])
    </div>
@endsection
