<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Random\Randomizer;
use Random\Engine\Secure;

class DeletePostModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $postId,
        public $uniqueId = "",

    )
    {
        $randomizer = new Randomizer(new Secure());
        $this->uniqueId = $randomizer ->getInt(100000,9999999);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-post-modal');
    }
}
