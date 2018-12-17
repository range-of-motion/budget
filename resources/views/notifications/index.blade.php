@extends('layout')

@section('title', 'Notifications')

@section('body')
    <div class="wrapper my-3">
        <h2>Notifications</h2>
        <div class="box mt-3">
            @foreach ($notifications as $notification)
                <div class="box__section row">
                    <div class="row__column">{{ __('notifications.' . $notification->action) }}</div>
                    <div class="row__column">{{ $notification->created_at }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
