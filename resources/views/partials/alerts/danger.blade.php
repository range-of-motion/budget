<div class="row alert alert-danger {{ $payload['classes'] }}">
    <div class="row__column row__column--compact alert-fa" >
        <i class="fas fa-times fa-fw"></i>
    </div>
    <div class="row__column text-center alert-message">
        {!! __('messages.' . $payload['message']) !!}
        @if($payload['message'] === 'login_failed.verify_account')
            <a class="alert-a" href="{{ route('resend_verify_registration') }}"> {{ __('messages.resend_verify_registration') }}</a>
        @endif
    </div>
</div>
