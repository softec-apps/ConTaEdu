<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalEditar extends Component
{

    public $id;
    public $desc;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $desc)
    {
        $this->id = $id;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-editar');
    }
}
