<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Tooltip extends Component
{
    public $text;
    public $position;
    public $buttonClass;
    public $class;

    public function __construct($text, $position = 'top', $buttonClass = '', $class = '')
    {
        $this->text = $text;
        $this->position = $position;
        $this->buttonClass = $buttonClass;
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        return view('components.tooltip');
    }
}
