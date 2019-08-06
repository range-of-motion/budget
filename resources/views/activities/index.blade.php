@extends('layout')

@section('title', __('models.activities'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('models.activities') }}</h2>
        <div class="box mt-3">
            @if (count($activities))
                @foreach ($activities as $activity)
                    <div class="box__section row">
                        <div class="row__column row__column--compact mr-2" style="width: 25px;">
                            @if ($activity->user)
                                <img class="avatar" src="{{ $activity->user->avatar }}" />
                            @endif
                        </div>
                        <div class="row__column row__column--middle">{{ $activity->user->name or __('activities.job_server') }} {{ mb_strtolower(__('activities.' . $activity->action)) }} {{ $activity->description() }}</div>
                        <div class="row__column row__column--middle row__column--compact">{{ $activity->formatted_created_at }}</div>
                    </div>
                @endforeach
            @else
                @include('partials.empty_state', ['payload' => 'activities', 'action' => false])
            @endif
        </div>
    </div>
@endsection
