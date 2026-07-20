<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request){
        if($request->filled('profile')){
            $username = $request->string('profile');
            $user = User::where('username', $username)->firstOrFail();
            $posts = $user->posts()
                ->paginate(15)
                ->withQueryString();

        }else if($request->filled('q')){
            $q = $request->string('q');
            $posts = Post::where('id', $q)
            ->orWhere('title', 'LIKE', '%' .$q . '%')
            ->orWhere('description', 'LIKE', '%' .$q . '%')
            ->orderByDesc('id')
            ->paginate(20);
        }else{
            $posts = Post::orderByDesc('id')->paginate(15);
        }
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
    
    public function store()
    {
        $validated  = request()->validate([
            'user_id' => ['required','integer','exists:users,id'],
            'title' => ['required','string','min:4','max:150'],
            'description' => ['required','string','min:4','max:500'],
            'image_path' => ['nullable','image','mimes:png,jpg,jpeg,svg','max:10240'] // MAX par KB
        ]);

        $validated['image_path'] = request()->hasFile('image')
            ?  request()->file('image')->store('posts','public')
            : "posts/default-image.png";

        $post = Post::create($validated); 
        $status = 201;
        $data = new PostResource($post);
        return response()->json($data,$status) ;
    }
    public function update(Post $post)
    {
        $validated  = request()->validate([
            'title' => ['required','string','min:4','max:150'],
            'description' => ['required','string','min:4','max:500'],
            'image_path' => ['nullable','image','mimes:png,jpg,jpeg,svg','max:10240'] // MAX par KB
        ]);
        if(request()->hasFile('image')){
            $validated['image_path'] =  request()->file('image')->store('posts','public');
        }else{
            unset($validated['image_path']);
        }
        $post->update($validated);
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $img_path = $post->image_path;
        if($img_path !== 'posts/default-image.png'){
            Storage::disk('public')->move(
                $img_path,
                'posts/trash/' . basename($img_path)
            );
        }
        $post->comments()->delete();
        $post->delete();

        return response()->json(null,204);
    }
}
