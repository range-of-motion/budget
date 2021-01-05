<?php

namespace App\Http\Livewire;

use App\Models\Widget;
use Livewire\Component;

class WidgetList extends Component
{
    public $widgets;

    protected $listeners = [
        'widgetCreated' => 'reloadWidgets'
    ];

    public function __construct()
    {
        $this->reloadWidgets();
    }

    public function reloadWidgets()
    {
        $this->widgets = request()->user()
            ->widgets()
            ->orderBy('sorting_index')
            ->get();
    }

    public function up(Widget $widget)
    {
        if ($widget->sorting_index > 0) {
            $previousWidget = Widget::where('user_id', $widget->user_id)
                ->where('sorting_index', $widget->sorting_index - 1)
                ->first();

            $previousWidget->update([
                'sorting_index' => $widget->sorting_index
            ]);

            $widget->update([
                'sorting_index' => $widget->sorting_index - 1
            ]);
        }

        $this->reloadWidgets();
    }

    public function down(Widget $widget)
    {
        if ($widget->sorting_index < count($this->widgets) - 1) {
            $nextWidget = Widget::where('user_id', $widget->user_id)
                ->where('sorting_index', $widget->sorting_index + 1)
                ->first();

            $nextWidget->update([
                'sorting_index' => $widget->sorting_index
            ]);

            $widget->update([
                'sorting_index' => $widget->sorting_index + 1
            ]);
        }

        $this->reloadWidgets();
    }

    public function delete(Widget $widget)
    {
        $widget->delete();

        /**
         * Move widgets with out-of-sync sorting index up by 1
         */

        $outOfSyncWidgets = Widget::where('user_id', $widget->user_id)
            ->whereRaw('sorting_index > ?', [$widget->sorting_index])
            ->get();

        foreach ($outOfSyncWidgets as $outOfSyncWidget) {
            $outOfSyncWidget->update([
                'sorting_index' => $outOfSyncWidget->sorting_index - 1
            ]);
        }

        $this->reloadWidgets();
    }

    public function render()
    {
        return view('livewire.widget-list');
    }
}
