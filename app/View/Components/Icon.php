<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Support\IconRenderer;

class Icon extends Component
{
    public string $name;
    public string $class;

    public function __construct(string $name, string $class = 'w-4 h-4')
    {
        $this->name = $name;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.icon');
    }
}
