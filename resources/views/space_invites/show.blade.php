@extends('layout')

@section('title', __('general.invite'))

@section('body')
    <div class="wrapper wrapper--narrow my-3">
        <h2>{{ __('general.invite') }}</h2>
        <div class="box mt-3">
            <div class="box__section">
                <h3 class="color-dark mb-1" v-pre>{{ __('general.invited_to') }} "{{ $invite->space->name }}"</h3>
                <div>{{ __('general.sent_by') }} {{ $invite->inviter->name }}.</div>
                <div class="row row--middle mt-2">
                    <form method="POST" action="{{ route('space_invites.accept', ['space' => $invite->space->id, 'invite' => $invite->id]) }}">
                        {{ csrf_field() }}
                        <button class="button">{{ __('actions.accept') }}</button>
                    </form>
                    <form method="POST" action="{{ route('space_invites.deny', ['space' => $invite->space->id, 'invite' => $invite->id]) }}">
                        {{ csrf_field() }}
                        <button class="button button--secondary ml-2">{{ __('actions.deny') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
