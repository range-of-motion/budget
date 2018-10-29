@extends('layout')

@section('title', __('actions.create') . ' ' . __('models.recurring'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.create') }} {{ __('models.recurring') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/recurrings" autocomplete="off">
                {{ csrf_field() }}
                <div class="box__section row">
                    <div class="row__column">
                        <div class="input input--small">
                            <label>Day</label>
                            <input type="text" name="day" />
                            <div style="font-weight: 700; font-size: 14px; margin-top: 5px;">1 - 28</div>
                            @include('partials.validation_error', ['payload' => 'day'])
                        </div>
                        <div class="input input--small mb-0">
                            <label>End</label>
                            <DatePicker name="end"></DatePicker>
                            @include('partials.validation_error', ['payload' => 'end'])
                            <input type="checkbox" name="end" value="" id="endForever" />
                            <label for="endForever">Forever</label>
                        </div>
                    </div>
                    <div class="row__column">
                        <div class="input input--small">
                            <label>Tag</label>
                            <select name="tag">
                                <option value="">-</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @include('partials.validation_error', ['payload' => 'tag'])
                        </div>
                        <div class="input input--small">
                            <label>Description</label>
                            <input type="text" name="description" />
                            @include('partials.validation_error', ['payload' => 'description'])
                        </div>
                        <div class="input input--small mb-0">
                            <label>Amount</label>
                            <input type="text" name="amount" />
                            @include('partials.validation_error', ['payload' => 'amount'])
                        </div>
                    </div>
                </div>
                <div class="box__section box__section--highlight row row--right">
                    <div class="row__column row__column--compact row__column--middle">
                        <a href="/tags">Cancel</a>
                    </div>
                    <div class="row__column row__column--compact ml-2">
                        <button class="button">{{ __('actions.create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
