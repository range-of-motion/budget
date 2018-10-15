@extends('layout')

@section('title', __('models.imports'))

@section('body')
    <div class="wrapper my-3">
        <div class="row mb-3">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.imports') }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/imports/create" class="button">{{ __('actions.create') }} {{ __('models.import') }}</a>
            </div>
        </div>
        <div class="box">
            @if (count($imports))
                <div class="box__section box__section--header row">
                    <div class="row__column">Name</div>
                    <div class="row__column">Status</div>
                </div>
                @foreach ($imports as $import)
                    <div class="box__section row">
                        <div class="row__column">{{ $import->name }}</div>
                        <div class="row__column">{{ $import->status }}</div>
                    </div>
                @endforeach
            @else
                @include('partials.empty_state', ['payload' => 'imports'])
            @endif
        </div>
    </div>
@endsection
