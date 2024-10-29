<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputPhone extends Component
{
    public $model;
    public $label;

    public function __construct($model, $label = 'Phone Number')
    {
        $this->model = $model;
        $this->label = $label;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-phone');
    }
}