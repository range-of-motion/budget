@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <form method="POST" action="/spendings">
                    {{ csrf_field() }}
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
                    <div class="input input--small">
                        <label>Amount</label>
                        <input type="text" name="amount" />
                        @include('partials.validation_error', ['payload' => 'amount'])
                    </div>
                    <button>@lang('actions.create')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
