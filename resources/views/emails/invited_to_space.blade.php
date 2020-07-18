@extends('emails.template')

@section('content')
    {{ $invite->inviter->name }} has invited you to "{{ $invite->space->name }}".

    <a href="{{ route('space_invites.show', ['space' => $invite->space->id, 'invite' => $invite->id]) }}">Check out your invite</a>
@endsection
