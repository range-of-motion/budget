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
                    <div class="row gutter">
                        <div class="column">
                            <label>Date</label>
                            <DatePicker></DatePicker>
                        </div>
                        <div class="column">
                            <label>Description</label>
                            <input type="text" name="description" />
                            <label>Amount</label>
                            <input type="text" name="amount" />
                        </div>
                    </div>
                    <button>@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
