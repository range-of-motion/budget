@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.billing') }}</h2>
@endsection

@section('settings_body')
    <div class="box">
        <div class="box__section">
            <div class="row" style="align-items: flex-start;">
                <div class="mr-1">
                    <div style="color: black;" class="mb-1">{{ ucfirst($user->plan) }}</div>
                    € 0.00
                </div>
                <a class="button button--small" href="#">Upgrade</a>
            </div>
        </div>
    </div>
@endsection
