@extends('layout')

@section('title', 'Activities')

@section('body')
    <div class="wrapper my-3">
        <h2>Activities</h2>
        <div class="box mt-3">
            @foreach ($activities as $activity)
                <div class="box__section row">
                    <div class="row__column row__column--compact mr-2" style="width: 25px;">
                        @if ($activity->user)
                            <img class="avatar" src="{{ $activity->user->avatar }}" />
                        @endif
                    </div>
                    <div class="row__column row__column--middle">{{ __('activities.' . $activity->action) }} #{{ $activity->entity_id }}</div>
                    <div class="row__column row__column--middle row__column--compact">{{ $activity->created_at->diffForHumans() }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
