<div class="box">
    @foreach ($widgets as $widget)
        <div wire:key="{{ $widget->id }}" class="box__section row">
            <div class="row__column row__column--compact mr-1">
                #{{ $widget->sorting_index + 1 }}
            </div>
            <div class="row__column">
                {{ ucfirst($widget->type) }}
                @if (count((array) $widget->properties))
                    ({{ ucfirst(str_replace('_', ' ', $widget->properties->{key($widget->properties)})) }})
                @endif
            </div>
            <div class="row__column">
                <button class="button link mr-1" wire:click="up({{ $widget }})" class="mr-1">
                    <i class="fas fa-arrow-alt-up"></i>
                </button>
                <button class="button link" wire:click="down({{ $widget }})">
                    <i class="fas fa-arrow-alt-down"></i>
                </button>
            </div>
            <div class="row__column row__column--compact">
                <button class="button link" wire:click="delete({{ $widget }})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endforeach
    @if (!count($widgets))
        <div class="box__section text-center">There aren't any widgets yet</div>
    @endif
</div>
