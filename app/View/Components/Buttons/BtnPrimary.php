<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnPrimary extends Component
{
    public $id;
    public $text;
    public $text_loading;
    public $size;
    public $type;
    public $class;
    public $onclick;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $text = "", 
        $text_loading = null, 
        $id = null, 
        $size = null, 
        $type = 'button', 
        $class = "", 
        $onclick = null
    )
    {
        $this->id = $id;
        $this->text = $text ?: "Salvar";
        $this->text_loading = $text_loading ?? "Aguarde...";
        $this->size = $size;
        $this->type = $type;
        $this->class = $class;
        $this->onclick = $onclick;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-primary');
    }
}
