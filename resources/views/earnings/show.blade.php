@extends('layout')

@section('title', $earning->description)

@section('body')
    <div class="wrapper my-3">
        <h2 v-pre>{{ $earning->description }}</h2>
        @include('partials.attachments', ['payload' => $earning])
    </div>
@endsection
