@extends('errors.layout')

@section('title', __('errors.server_side_error'))

@section('code', '500')

@section('message', __('errors.server_side_error_msg'))
