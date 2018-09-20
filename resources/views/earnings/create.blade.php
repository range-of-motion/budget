@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div class="box">
            <form method="POST" action="/earnings">
                {{ csrf_field() }}
                <div class="box__section">
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
                    <div class="input input--small">
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
