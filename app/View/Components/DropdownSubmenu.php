<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownSubmenu extends Component
{
    public $href;
    public $title;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct($href, $title, $active)
    {
        $this->href = $href;
        $this->title = $title;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-submenu');
    }
}
