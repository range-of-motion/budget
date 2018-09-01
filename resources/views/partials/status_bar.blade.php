<div class="row {{ $payload['classes'] }}" style="
    padding: 15px;
    color: #FFF;
    background: #FE7C4D;
    border-radius: 5px;
">
    <div class="row__column row__column--compact">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <div class="row__column text-center" style="font-weight: 600;">{{ $payload['status'] }}</div>
</div>
