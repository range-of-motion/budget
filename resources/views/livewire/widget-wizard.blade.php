<div>
    @if ($visible)
        <div class="box">
            <div class="box__section">
                <div class="input input--small">
                    <label>Type</label>
                    <select wire:model="selectedType">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                @if (count($expectedProperties))
                    <div class="input input--small">
                        <label>Properties</label>
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
                    <button class="button mr-1" wire:click="persist">Create</button>
                    <button class="button button--secondary" wire:click="toggle">Cancel</button>
                </div>
            </div>
        </div>
    @else
        <button wire:click="toggle" class="button">Create</button>
    @endif
</div>
