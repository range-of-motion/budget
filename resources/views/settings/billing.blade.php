@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.billing') }}</h2>
@endsection

@section('settings_body_formless')
    <div class="box">
        <div class="box__section">
            <div class="row" style="align-items: flex-start;">
                <div class="mr-1">
                    <div style="color: black;" class="mb-1">{{ ucfirst($user->plan) }}</div>
                    € 0.00
                </div>
                @if ($user->plan === 'standard')
                    <form method="POST" action="{{ route('settings.billing.upgrade') }}">
                        {{ csrf_field() }}
                        <button class="button button--small">Upgrade</button>
                    </form>
                @else
                    <a class="button button--small button--secondary" href="#">Cancel</a>
                @endif
            </div>
        </div>
    </div>
@endsection
