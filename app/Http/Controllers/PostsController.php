<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use App\Models\Post ;

// dd (die document : Stop all code and output a value for fast debugging)
class PostsController extends Controller
{
    public function index(){
        // SELECT * FROM Post (Without condition-filter-limit...)
        // $posts = Post::all();
        // Build query then execute with get()
        $posts = Post::orderBy('id','DESC')->get();
        return view(view : 'posts.index', data : [
            "posts" => $posts
        ]);
    }

    public function show($post){
        // Method 1 : Get one row with id or return 404 http response
        $post = Post::findOrFail($post);
        // Method 2 : return first row founded with a condition or return 404 http response
        // $post = Post::where('id',$post)->firstOrFail();
        // Method 3 : Route Model binding 
        // in function parameter specify type of url parameter -> public function show(Post $post){}
        
        return view(view : 'posts.show', data : [
            'post' => $post
        ]);
    }

    public function create(){
        $users = User::orderBy('name')->get();
        return view(view : "posts.create", data : [
            'users' => $users
        ]);
    }

    public function store(){
        // dd(request(), request()->server);

        // Get all form fields :
        request()->all();

        // Get one field
        request()->all()['title'];
        request()->input('title');
        request()->title;
        // Get only specific fields
        request()->only(['title', 'description']);

        // Step 1 - Get Data
        $r = request();
        // Step 2 - Save in database
        // Method 1 : create new object from class model (all colomns authorized):
        // $post = new Post;
        // $post->title = $r->title;
        // $post->description = $r->description;
        // $post->save();

        // Method 1 : use a static method (accessible just to fillable collumns defined in models) :
        $newPost = Post::create([
            "title"       => $r->title,
            "description" => $r->description,
        ]);
        
        // Step 3 - Redirect To Created Post View
        return to_route("posts.show",[$newPost->id]);
    }

    public function edit(Post $post){
        return view(view : "posts.edit", data : [
            "post" => $post
        ]);
    }

    public function update(Post $post){
        $r = request();
        // Method 1 : find with id then update
        // Post::find($post)->update([
        //     'title' => $r->title,
        //     'description' => $r->description,
        // ]);
        // Method 2 : Use Route Model Binding then update it
        $post->update([
            'title' => $r->title,
            'description' => $r->description,
        ]);

        return to_route('posts.show', $post->id);
    }

    public function destroy(Post $post){
        // Delete from Database with just Id of row
        // $post = Post::find($postId);
        // $post->delete();

        // Post::destroy([$post]);

        // Or Directly
        $post->delete();
        
        return to_route('posts.index');
    }

}