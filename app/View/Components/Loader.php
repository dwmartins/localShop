<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Loader extends Component
{
    public $color;
    public $size;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct($color = 'primary', $size = '', $class = "")
    {
        $this->color = $color;
        $this->size = $size;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.loader');
    }
}
