@extends('layout')

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <h1 class="text-center">@yield('code', __('errors.oh_no'))</h1>
        <h2 class="text-center">@yield('message')</h2>
    </div>
@endsection
