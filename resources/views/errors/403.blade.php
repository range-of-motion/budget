@extends('errors.layout')

@section('title', __('errors.forbidden'))

@section('code', '403')

@section('message', __('errors.forbidden_msg'))
