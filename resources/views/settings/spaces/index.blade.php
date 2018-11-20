@extends('settings.layout')

@section('settings_body')
    <div class="box">
        <ul class="box__section">
            @foreach ($spaces as $space)
                <li>{{ $space->name }} &middot; {{ ucfirst($space->pivot->role) }}</li>
            @endforeach
        </ul>
    </div>
@endsection
