@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Earnings &middot; Create</h3>
            </div>
            <div class="section">
                <form method="POST" action="/earnings">
                    {{ csrf_field() }}
                    <label>Date</label>
                    <DatePicker></DatePicker>
                    <label>Description</label>
                    <input type="text" name="description" />
                    <label>Amount</label>
                    <input type="text" name="amount" />
                    <button>@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
