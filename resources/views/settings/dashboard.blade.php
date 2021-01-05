@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.dashboard') }}</h2>
@endsection

@section('settings_body_formless')
    <div class="mb-2">
        <livewire:widget-wizard />
    </div>
    <livewire:widget-list />
@endsection
