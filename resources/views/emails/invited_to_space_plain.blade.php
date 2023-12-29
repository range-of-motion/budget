{{ $invite->inviter->name }} has invited you to "{{ $invite->space->name }}".

Use the link below to check out your invite.

{{ route('space_invites.show', ['space' => $invite->space->id, 'invite' => $invite->id]) }}
