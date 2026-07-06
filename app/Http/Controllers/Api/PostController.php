<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::when($request->filled('q'), function($query) use ($request){
            $query->where('id', $request->q)
                ->orWhere('title', 'LIKE', "%" . $request->q . "%")
                ->orWhere('description', 'LIKE', "%" . $request->q . "%");
        })
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $total_posts = Post::count();

        return compact('posts','total_posts');
    }
}
