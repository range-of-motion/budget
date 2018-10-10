@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.create') }} {{ __('general.spending') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/spendings" autocomplete="off">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>Tag</label>
                        <select name="tag_id">
                            <option value="">-</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @include('partials.validation_error', ['payload' => 'tag_id'])
                    </div>
                    <div class="input input--small">
                        <label>Date</label>
                        <DatePicker></DatePicker>
                        @include('partials.validation_error', ['payload' => 'date'])
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
                <div class="box__section box__section--highlight text-right">
                    <button class="button">@lang('actions.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
