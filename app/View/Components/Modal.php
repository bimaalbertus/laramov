<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Modal extends Component
{
    public $open;
    public $closeIcon;

    public function __construct($open = 'isOpen', $closeIcon = 'block')
    {
        $this->open = $open;
        $this->closeIcon = $closeIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
