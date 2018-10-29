@extends('emails.template')

@section('content')
    Heads up! Your password has been changed ({{ $updated_at }} CEST).
@endsection
