<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class PostForm extends Component
{
    public function __construct(
        public $users = [],
        public $action = "", 
        public $method = "POST", 
        public $titleValue = "", 
        public $descValue = "", 
        public $submitValue = "Create", 
        public $submitColor = "primary",
        public $postId = 0
    ){
        $this->users = User::orderBy('name')->get();
    }
    public function render(): View|Closure|string
    {
        return view('components.post-form');
    }
}
