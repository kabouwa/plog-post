<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostForm extends Component
{
    public function __construct(
        public $action = "", 
        public $method = "POST", 
        public $titleValue = "", 
        public $descValue = "", 
        public $submitValue = "Create", 
        public $submitColor = "primary"
    ){}
    public function render(): View|Closure|string
    {
        return view('components.post-form');
    }
}
