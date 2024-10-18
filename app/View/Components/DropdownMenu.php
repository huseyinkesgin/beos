<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownMenu extends Component
{
    public $title;
    public $icon;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $icon, $active = '', $menuId = '')
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->active = $active;
        // Eğer menü kimliği gerekirse burada kullanabilirsiniz
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-menu');
    }
}
