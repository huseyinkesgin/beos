<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputDate extends Component
{
    public $label;
    public $model;
    /**
     * Create a new component instance.
     */
    public function __construct($label,  $model)
    {
        $this->label = $label;
        $this->model = $model;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-date');
    }
}
