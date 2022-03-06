<div>
    @if ($visible)
        <div class="box">
            <div class="box__section">
                <div class="input input--small">
                    <label>{{ __('fields.type') }}</label>
                    <select wire:model="selectedType">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ __('configuration.widget.'.$type) }}</option>
                        @endforeach
                    </select>
                </div>
                @if (count($expectedProperties))
                    <div class="input input--small">
                        <label>{{ __('general.properties') }}</label>
                        @foreach ($expectedProperties as $key => $value)
                            <div>
                                <div class="mb-05">{{ ucfirst($key) }}</div>
                                <select wire:model="providedProperties.{{ $key }}">
                                    @foreach ($value as $y)
                                        <option value="{{ $y }}">{{ ucfirst(str_replace('_', ' ', $y)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    <button class="button mr-1" wire:click="persist">{{ __('actions.create') }}</button>
                    <button class="button button--secondary" wire:click="toggle">{{ __('actions.cancel') }}</button>
                </div>
            </div>
        </div>
    @else
        <button wire:click="toggle" class="button">{{ __('actions.create') }}</button>
    @endif
</div>
