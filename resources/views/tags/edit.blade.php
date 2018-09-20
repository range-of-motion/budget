@extends('layout')

@section('title', __('actions.edit') . ' ' . __('general.tag'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.edit') }} {{ __('general.tag') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/tags/{{ $tag->id }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small mb-0">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $tag->name }}" />
                        @include('partials.validation_error', ['payload' => 'name'])
                    </div>
                </div>
                <div class="box__section box__section--highlight row row--right">
                    <div class="row__column row__column--compact row__column--middle">
                        <a href="/tags">Cancel</a>
                    </div>
                    <div class="row__column row__column--compact ml-2">
                        <button class="button">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
