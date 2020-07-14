@extends('layout')

@section('title', __('actions.edit') . ' ' . __('models.space'))

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">{{ __('actions.edit') }} {{ __('models.space') }}</h2>
        <form method="POST" action="/spaces/{{ $space->id }}/update">
            {{ csrf_field() }}
            <div class="box">
                <div class="box__section row">
                    <div class="row__column">
                        <h2>{{ __('general.general') }}</h2>
                    </div>
                    <div class="row__column row__column--double">
                        <div class="input input--small">
                            <label>{{ __('fields.name') }}</label>
                            <input type="text" name="name" value="{{ $space->name }}" />
                        </div>
                        <div class="input input--small mb-0">
                            <label>{{ __('fields.currency') }}</label>
                            <select disabled>
                                <option>{{ $space->currency->name }}</option>
                            </select>
                            <div class="hint mt-05">You cannot modify the currency anymore</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row--right mt-2">
                <a class="button button--secondary mr-2" href="/settings/spaces">{{ __('actions.cancel') }}</a>
                <button class="button">{{ __('actions.save') }}</button>
            </div>
        </form>
        <div class="box mt-3">
            <div class="box__section row">
                <div class="row__column">
                    <h2>{{ __('general.members') }}</h2>
                </div>
                <div class="row__column row__column--double">
                    @foreach ($space->users as $i => $user)
                        <div class="{{ $i > 0 ? 'mt-2' : null }}">
                            <div class="color-dark mb-1">{{ $user->name }}</div>
                            <div class="fs-sm">{{ ucfirst($user->pivot->role) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
