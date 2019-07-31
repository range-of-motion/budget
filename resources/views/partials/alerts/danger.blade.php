<div class="row {{ $payload['classes'] }}" style="
    padding: 15px;
    color: #FFF;
    background: #F86380;
    border-radius: 5px;
">
    <div class="row__column row__column--compact" style="margin: auto; width: 5%;">
        <i class="fas fa-times fa-fw"></i>
    </div>
    <div class="row__column text-center" style="font-weight: 600;">
        {!! __('messages.' . $payload['message']) !!}
        @if($payload['message'] === 'login_failed.verify_account')
            <a class="alert-a" href="{{ route('resend_verify_registration') }}"> {{ __('messages.resend_verify_registration') }}</a>
        @endif
    </div>
</div>
