<?php

namespace App\View\Components\Checkboxes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $id;
    public $description;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null, $description = "", $class = "")
    {
        $this->id = $id;
        $this->description = $description;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkboxes.checkbox');
    }
}
