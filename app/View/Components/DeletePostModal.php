<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Random\Randomizer;
use Random\Engine\Secure;

class DeletePostModal extends Component
{
    private static int $counter = 659587;
    public function __construct(
        public $postId,
        public $uniqueId = 0,
    )
    {
        $this->uniqueId = static::$counter++ ;

    }
    public function render(): View|Closure|string
    {
        return view('components.delete-post-modal');
    }
}