@extends('layout')

@section('body')
    <h1 class="spacing-bottom-large">Earnings &middot; Create</h1>
    <div class="box spacing-small">
        <form method="POST" action="/earnings">
            {{ csrf_field() }}
            <label>Date</label>
            <DatePicker></DatePicker>
            <label>Description</label>
            <input type="text" name="description" />
            <label>Amount</label>
            <input type="text" name="amount" />
            <input type="submit" value="Create" />
        </form>
    </div>
@endsection
