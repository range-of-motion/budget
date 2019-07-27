@extends('layout')

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <h2 class="text-center">@yield('code', __('errors.oh_no'))</h2>
        <h3 class="text-center">@yield('message')</h3>
    </div>
@endsection
