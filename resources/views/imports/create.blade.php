@extends('layout')

@section('title', __('actions.create') . ' ' . __('models.import'))

@section('body')
    <div class="wrapper my-3">
        <h2>{{ __('actions.create') }} {{ __('models.import') }}</h2>
        <div class="box mt-3">
            <form method="POST" action="/imports" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>{{ __('fields.name') }}</label>
                        <input type="text" name="name" />
                        @include('partials.validation_error', ['payload' => 'name'])
                    </div>
                    <div class="input input--small mb-0">
                        <label>{{ __('fields.file') }}</label>
                        <input type="file" name="file" />
                        @include('partials.validation_error', ['payload' => 'file'])
                    </div>
                </div>
                <div class="box__section box__section--highlight row row--right">
                    <div class="row__column row__column--compact row__column--middle">
                        <a href="/imports">{{ __('actions.cancel') }}</a>
                    </div>
                    <div class="row__column row__column--compact ml-2">
                        <button class="button">{{ __('actions.create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
