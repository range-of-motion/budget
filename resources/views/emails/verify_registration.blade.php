@extends('emails.template')

@section('content')
    Welcome aboard, {{ $name }}

    We're going to help you get insight into your personal finances.

    No more dealing with pesky, half-assed spreadsheets.

    <a href="{{ config('app.url') . '/dashboard' }}">Go get started</a>
@endsection
