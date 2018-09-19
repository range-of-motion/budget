@extends('layout')

@section('title', __('actions.create') . ' ' . __('general.tag'))

@section('body')
    <div class="wrapper my-4">
        <div class="box">
            <form method="POST" action="/tags">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>Name</label>
                        <input type="text" name="name" />
                    </div>
                </div>
                <div class="box__section row row--right">
                    <div class="row__column row__column--compact row__column--middle">
                        <a href="/tags">Cancel</a>
                    </div>
                    <div class="row__column row__column--compact ml-2">
                        <button class="button">{{ __('actions.create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
