@extends('errors.layout')

@section('title', __('errors.unauthorized'))

@section('code', '401')

@section('message', __('errors.unauthorized_msg'))
