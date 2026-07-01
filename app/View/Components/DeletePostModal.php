<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Random\Randomizer;
use Random\Engine\Secure;

class DeletePostModal extends Component
{
    public function __construct(
        public $post,
    )
    {
    }
    public function render(): View|Closure|string
    {
        return view('components.delete-post-modal');
    }
}