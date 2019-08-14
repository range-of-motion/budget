<div class="box__section text-center">
    <div class="mb-1">{{ __('messages.empty_state', ['resource' => strtolower(__('models.' . $payload))]) }}</div>
    @if(!isset($action))
        @if(!isset($create))
            <a href="/{{ $payload }}/create" style="font-size: 14px;">{{ __('actions.create') }}</a>
        @else
            <a href="/{{ $create }}/create" style="font-size: 14px;">{{ __('actions.create') }}</a>
        @endif
    @endif
</div>
