@extends('layout')

@section('title', __('models.transactions'))

@section('body')
    <div class="wrapper my-3" style="max-width: 900px;">
        <div class="row row--bottom mb-3">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.transactions') }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/transactions/create" class="button">{{ __('actions.create') }} {{ __('models.transactions') }}</a>
            </div>
        </div>
        <transactions :periods='@json($periods)' />
    </div>
@endsection
