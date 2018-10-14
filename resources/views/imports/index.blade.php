@extends('layout')

@section('title', __('models.imports'))

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">{{ __('models.imports') }}</h2>
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
