@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <form method="POST" action="/earnings">
                    {{ csrf_field() }}
                    <div class="input input--small">
                        <label>Date</label>
                        <DatePicker></DatePicker>
                    </div>
                    <div class="input input--small">
                        <label>Description</label>
                        <input type="text" name="description" />
                    </div>
                    <div class="input input--small">
                        <label>Amount</label>
                        <input type="text" name="amount" />
                    </div>
                    <button>@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
