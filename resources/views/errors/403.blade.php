@extends('errors.layout')

@section('title', __('errors.forbidden'))

@section('code', '403')

@section('message')
    {{ (isset($e) ? __($e->getMessage()) : __('errors.' . $message)) }}
@endsection
