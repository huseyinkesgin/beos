<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioButton extends Component
{

    public $label;
    public $id;
    public $value;
    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $id, $value, $model)
    {
        $this->label = $label;
        $this->id = $id;
        $this->value = $value;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-button');
    }
}
