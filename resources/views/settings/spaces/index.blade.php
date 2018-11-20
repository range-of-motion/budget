@extends('settings.layout')

@section('settings_title')
    <h2>{{ __('models.spaces') }}</h2>
    <p class="mt-1 mb-3">Spaces can be used to separate your finances in Budget. For example&mdash;you can have a space for your personal finances and another space for your business' finances.</p>
@endsection

@section('settings_body')
    <div class="box">
        <ul class="box__section">
            @foreach ($spaces as $space)
                <li>{{ $space->name }} &middot; {{ ucfirst($space->pivot->role) }}</li>
            @endforeach
        </ul>
    </div>
@endsection
