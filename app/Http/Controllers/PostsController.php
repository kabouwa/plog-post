<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post ;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view(view : 'posts.index', data : [
            "posts" => $posts
        ]);
    }

    public function show($postId){
        $post = Post::find($postId);
        return view(view : 'posts.show', data : [
            'post' => $post
        ]);
    }

    public function create(){
        return view(view : "posts.create");
    }

    public function store(){
        date_default_timezone_set('Africa/Casablanca');

        // Request Object using dd (die document : Stop all code and output a value for fast debugging
        // dd(request(), request()->server);
        // Get one field
        request()->all()['title'];
        request()->input('title');
        request()->title;
        // Get only specific fields
        request()->only(['title', 'description']);

        // Get all form fields :
        request()->all();


        // Step 1 - Get Data
        $r = request();
        // Step 2 - Save in database
        $newPost = Post::create([
            "title" => $r->title,
            "description" => $r->description,
        ]);
        
        // Step 3 - Redirect to Posts Page
        return to_route("posts.show",[$newPost->id]);
    }

    public function edit($postId){
        $post = Post::find($postId);
        return view(view : "posts.edit", data : [
            "post" => $post
        ]);
    }

    public function update($postId){
        $r = request();
        Post::find($postId)->update([
            'title' => $r->title,
            'description' => $r->description,
        ]);
        return to_route('posts.show', $postId);
    }

    public function destroy($postId){
        // Delete from Database
        // Post::find($postId)->delete();
        Post::destroy([$postId]);
        return to_route('posts.index');
    }

}