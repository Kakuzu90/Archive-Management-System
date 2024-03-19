<?php

namespace App\View\Components;

use Illuminate\View\Component;

class widget extends Component
{
    public $title;
    public $icon;
    public $color;
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $icon, string $color, int $count)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->color = $color;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.widget');
    }
}
