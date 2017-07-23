@extends('layout')

@section('body')
    <h1>Spendings</h1>
    <div class="box">
        <div class="box__section">
            <ul>
                @foreach (Auth::user()->spendings as $spending)
                    <li>{{ $spending->description }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
