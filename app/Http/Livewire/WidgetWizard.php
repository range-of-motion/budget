<?php

namespace App\Http\Livewire;

use App\Models\Widget;
use Livewire\Component;

class WidgetWizard extends Component
{
    public $visible;
    public $types;
    public $selectedType;
    public $expectedProperties;
    public $providedProperties;

    public function __construct()
    {
        $this->visible = false;
        $this->types = array_keys(config('widgets.types'));
        $this->selectedType = $this->types[0];
        $this->reloadExpectedAndProvidedProperties();
    }

    public function reloadExpectedAndProvidedProperties()
    {
        $this->expectedProperties = config('widgets.types.' . $this->selectedType . '.properties');

        /**
         * Reset the provided properties
         */

        $this->providedProperties = [];

        foreach ($this->expectedProperties as $key => $value) {
            $this->providedProperties[$key] = $value[0]; // Assuming that $value is an array, and that it has items
        }
    }

    public function toggle()
    {
        $this->visible = !$this->visible;
    }

    public function persist()
    {
        $user = request()->user();

        $existingWidgetsAmount = $user->widgets()->count();

        Widget::create([
            'user_id' => $user->id,
            'type' => $this->selectedType,
            'sorting_index' => $existingWidgetsAmount,
            'properties' => $this->providedProperties
        ]);

        $this->emit('widgetCreated');

        $this->visible = false;
    }

    public function updatedSelectedType()
    {
        $this->reloadExpectedAndProvidedProperties();
    }

    public function render()
    {
        return view('livewire.widget-wizard');
    }
}
