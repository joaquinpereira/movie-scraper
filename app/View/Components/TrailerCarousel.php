<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrailerCarousel extends Component
{
    public $trailers;
    /**
     * Create a new component instance.
     */
    public function __construct($trailers)
    {
        $this->trailers = $trailers;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trailer-carousel');
    }
}
