<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Template;

class ModalRegister extends Component
{
    /**
     * Create a new component instance.
     */
    public $templates;

    public function __construct()
    {
        $this->templates = Template::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-register');
    }
}
