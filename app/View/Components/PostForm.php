<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class PostForm extends Component
{
    public function __construct(
        public $action = "", 
        public $method = "POST", 
        public $submitValue = "Create", 
        public $submitColor = "primary",
        public $titleValue = "", 
        public $descValue = "", 
        public $postId = 0,
        public $creatorId = 0
    ){
    }
    public function render(): View|Closure|string
    {
        return view('components.forms.post-form',data : [
            'users' => User::orderBy('name')->get()
        ]);
    }
}
