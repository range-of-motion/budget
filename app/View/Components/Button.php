<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    public $target;

    public function __construct($target)
    {
        $this->target = $target;
    }

    public function render(): View
    {
        return view('components.button');
    }
}
