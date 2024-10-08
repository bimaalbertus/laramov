<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Jumbotron extends Component
{
    public $title;
    public $datas;

    public function __construct($title = 'Title', $datas)
    {
        $this->title = $title;
        $this->datas = $datas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jumbotron');
    }
}
