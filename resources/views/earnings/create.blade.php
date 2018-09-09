@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div class="box">
            <div class="box__section">
                <form method="POST" action="/earnings">
                    {{ csrf_field() }}
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
                    <button class="button">@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
