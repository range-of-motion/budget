@extends('errors.layout')

@section('title', __('errors.service_unavailable'))

@section('code', '503')

@section('message', __('errors.service_unavailable_msg'))
