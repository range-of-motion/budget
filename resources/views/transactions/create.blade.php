@extends('layout')

@section('title', __('actions.create') . ' Transaction')

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">{{ __('actions.create') }} Transaction</h2>
        <transaction-wizard></transaction-wizard>
    </div>
@endsection
