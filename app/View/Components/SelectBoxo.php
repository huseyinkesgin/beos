<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectBoxo extends Component
{
    public $label;
    public $model;
    public $options;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $model, $options = [])
    {
        $this->label = $label;
        $this->model = $model;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-boxo');
    }
}
