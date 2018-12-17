@extends('layout')

@section('title', 'Notifications')

@section('body')
    <div class="wrapper my-3">
        <h2>Notifications</h2>
        <div class="box mt-3">
            @foreach ($notifications as $notification)
                <div class="box__section row">
                    <div class="row__column row__column--compact mr-2" style="width: 25px;">
                        @if ($notification->user)
                            <img class="avatar" src="{{ $notification->user->avatar }}" />
                        @endif
                    </div>
                    <div class="row__column row__column--middle">{{ __('notifications.' . $notification->action) }}</div>
                    <div class="row__column row__column--middle row__column--compact">{{ $notification->created_at->diffForHumans() }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
