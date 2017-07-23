@extends('layout')

@section('body')
    <h1>Spendings</h1>
    <div class="box">
        <ul class="box__section">
            @foreach (Auth::user()->spendings as $spending)
                <li>{{ $spending->description }}</li>
            @endforeach
        </ul>
    </div>
@endsection
