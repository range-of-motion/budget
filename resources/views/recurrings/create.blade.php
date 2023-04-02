@extends('layout')

@section('title', __('actions.create') . ' ' . __('models.recurring'))

@section('body')
    <div class="wrapper mw-400 my-3">
        <h2 class="mb-3">{{ __('actions.create') }} {{ __('models.recurring') }}</h2>
        <form method="POST" action="{{ route('recurrings.store') }}" autocomplete="off">
            {{ csrf_field() }}
            <div class="input input--small">
                <label>Day</label>
                <input type="text" name="day" />
                <div style="font-weight: 700; font-size: 14px; margin-top: 5px;">1 - 28</div>
                @include('partials.validation_error', ['payload' => 'day'])
            </div>
            <div class="input input--small">
                <label>End</label>
                <DatePicker name="end"></DatePicker>
                @include('partials.validation_error', ['payload' => 'end'])
                <input type="checkbox" name="end" value="" id="endForever" />
                <label for="endForever">Forever</label>
            </div>
            <div class="input input--small">
                <label>Tag</label>
                <searchable
                    name="tag"
                    :items='@json($tags)'
                    initial="{{ old('tag') }}"></searchable>
                @include('partials.validation_error', ['payload' => 'tag'])
            </div>
            <div class="input input--small">
                <label>Description</label>
                <input type="text" name="description" />
                @include('partials.validation_error', ['payload' => 'description'])
            </div>
            <div class="input input--small">
                <label>Amount</label>
                <input type="text" name="amount" />
                @include('partials.validation_error', ['payload' => 'amount'])
            </div>
            <div class="row row--right">
                <div class="row__column row__column--compact">
                    <button class="button">{{ __('actions.create') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
