<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    public $label;
    public $id;
    public $type;
    public $model;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $id, $model, $type = 'text')
    {
        $this->label = $label;
        $this->id = $id;
        $this->type = $type;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-text');
    }
}
