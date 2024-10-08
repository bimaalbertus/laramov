<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowMore extends Component
{
    public $text;
    public $limit;

    public function __construct($text, $limit = 100)
    {
        $this->text = $text;
        $this->limit = $limit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-more');
    }
}
