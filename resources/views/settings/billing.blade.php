@extends('settings.layout')

@section('settings_title')
    <h2 class="mb-3">{{ __('general.billing') }}</h2>
@endsection

@section('settings_body_formless')
    <div class="box">
        <div class="box__section">
            <div class="row row--middle mb-1">
                <div style="color: black;" class="mr-1">{{ $stripeSubscription ? 'Premium' : 'Standard' }}</div>
                @if (!$stripeSubscription)
                    <form method="POST" action="{{ route('settings.billing.upgrade') }}">
                        {{ csrf_field() }}
                        <button class="button button--small">Upgrade</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('settings.billing.cancel') }}">
                        {{ csrf_field() }}
                        <button class="button button--small button--secondary">Cancel</button>
                    </form>
                @endif
            </div>
            € {{ $stripeSubscription ? \App\Helper::formatNumber($stripeSubscription->plan->amount / 100) : '0.00' }} per month @if ($stripeSubscription)&middot; Next payment due on {{ date('Y-m-d', $stripeSubscription->current_period_end) }}@endif
        </div>
    </div>
@endsection
