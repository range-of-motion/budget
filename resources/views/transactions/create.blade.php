@extends('layout')

@section('title', __('actions.create') . __('models.transaction'))

@section('body')
    <div class="wrapper mw-400 my-3">
        <h2 class="mb-3">{{ __('actions.create') }} . {{ __('models.transaction') }}</h2>
        <transaction-wizard :tags='@json($tags)'></transaction-wizard>
    </div>
@endsection
