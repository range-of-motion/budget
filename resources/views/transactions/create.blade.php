@extends('layout')

@section('title', __('actions.create') . ' Transaction')

@section('body')
    <div class="wrapper mw-400 my-3">
        <h2 class="mb-3">{{ __('actions.create') }} Transaction</h2>
        <transaction-wizard :tags='@json($tags)' :recurrings-intervals='@json($recurringsIntervals)'></transaction-wizard>
    </div>
@endsection
