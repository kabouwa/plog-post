<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use App\Models\Post ;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// dd (die document : Stop all code and output a value for fast debugging)
/**
 * Redirection :
 * redirect('https://www.google.com/')
 * redirect()->back()
 * redirect()->route('posts.index)  OR to_route('posts.index)
 * ->with('success','Post created!')
 * ->withInputs
 */

class PostController extends Controller implements HasMiddleware
{
    public static function middleware() : array{
        return [
            new Middleware('auth' , only : ['create','store','edit','update','destroy'])
        ];
    }

    private function AuthorizeAdminOrOwner(Post $post){
        if(
            Auth::user()->id !== $post->user_id
            && !Auth::user()->is_admin
        ) abort(403);
    }

    public function index(Request $request){
        // SELECT * FROM Post (Without condition-filter-limit...)
        // $posts = Post::all();
        // Build query then execute with get()

        if($request->filled('profile')){
            $username = $request->string('profile');
            $posts = Post::whereHas('user', function($query) use ($username){
                $query->where('username',$username);
            })
                ->paginate(15)
                ->withQueryString();
            $total = Post::whereHas('user', function($query) use ($username){
                $query->where('username',$username);
            })
                ->count();
        }else if($request->filled('q')){
            // Jointure
            $posts = Post::where('id', request('q'))
            ->orWhere('title', 'LIKE', '%' . request('q') . '%')
            ->paginate(15);
            $total = Post::count('id');
        }else{
            $posts = Post::orderByDesc('id')
            ->paginate(15);
            $total = Post::count('id');
        }
        return view(view : 'posts.index', data : [
            "posts" => $posts,
            "total" => $total
        ]);
    }

    public function show($post){
        // Method 1 : Get one row with id or return 404 http response
        $post = Post::findOrFail($post);
        // Method 2 : return first row founded with a condition or return 404 http response
        // $post = Post::where('id',$post)->firstOrFail();
        // Method 3 : Route Model binding
        // in function parameter specify type of url parameter -> public function show(Post $post){}

        return view(view : 'posts.show', data : compact('post') );
    }

    public function create(){
        $users = User::orderBy('name')->get();
        return view(view : "posts.create", data : compact('users') );
    }

    public function store(Request $request){
        // dd(request(), request()->server);

        // Get all form fields :
        request()->all();

        // Get one field
        request()->all()['title'];
        request()->input('title');
        request()->title;
        // Get only specific fields
        request()->only(['title', 'description']);

        // Step 1 - Validate
        $validated  = request()->validate([
            'title' => ['required','string','min:4','max:150'],
            'description' => ['required','string','min:4','max:500'],
            'image' => ['image','mimes:png,jpg,jpeg,svg','max:10240'] // MAX par KB
        ]);
        // Save image after validated it store(folderName , fileSystemDisk)
        $img_path = request()->hasFile('image')
            ?  request()->file('image')->store('posts','public')
            : "posts/post-no-image.png"; // Generate a unique file name

        // Or with custom name
        /**
         * $image = request()->file('image');
         * $img_path = 'post-img-id' . request()->user()->id . rand() .'-' . $image->getClientOriginalName();
         * $image->storeAs('posts',$img_path,'public');
         */

        // Step 2 - Get Data
        // $r = request();


        // Step 3 - Save in database
        // Method 1 : create new object from class model (all colomns authorized):
        // $post = new Post;
        // $post->title = $r->title;
        // $post->description = $r->description;
        // $post->save();


        // Method 2 : use a static method (accessible just to fillable collumns defined in models) :
        // $newPost = Post::create([
        //     "title"       => $r->title,
        //     "description" => $r->description,
        //     "user_id" => $r->creator,
        // ]);

        // Just Take Validated data
        $post = Post::create([
            "user_id"     => request()->user()->id,
            "title"       => $validated['title'],
            "description" => $validated['description'],
            "image_path"  => $img_path,
        ]);

        // Step 4 - Redirect To Created Post View
        return to_route("posts.show", $post->id)
            ->with('alert','Post created successfuly')
            ->with('type','success')
            ->with('accent','Done');
    }

    public function edit(Post $post){
        $this->AuthorizeAdminOrOwner($post);

        return view(view : "posts.edit", data : [
            "post" => $post
        ]);
    }

    public function update(Post $post){
        $this->AuthorizeAdminOrOwner($post);

        $r = request();
        // Method 1 : find with id then update
        // Post::find($post)->update([
        //     'title' => $r->title,
        //     'description' => $r->description,
        // ]);
        // Method 2 : Use Route Model Binding then update it

        $validated  = request()->validate([
            'title' => ['required','string','min:4','max:150'],
            'description' => ['required','string','min:4','max:500'],
            'image' => ['image','mimes:png,jpg,jpeg,svg','max:10240']
        ]);

        if(request()->hasFile('image')){
            if($post->image_path !== 'posts/post-no-image.png'){
                Storage::disk('public')->move(
                    $post->image_path,
                    'posts/trash/' . basename($post->image_path)
                );
            }
            $validated['image_path'] = request()->file('image')->store('posts','public');
        }else{
            unset($validated['image']);
        }

        $post->update($validated);

        return to_route('posts.show', $post)
                ->with('alert','Post Updated successfuly')
                ->with('accent','Done')
                ->with('type','success');
    }

    public function destroy(Post $post){
        $this->AuthorizeAdminOrOwner($post);
        // Delete from Database with just Id of row
        // $post = Post::find($postId);
        // $post->delete();

        // Post::destroy([$post]);

        // Or Directly
        $post->delete();

        return redirect()->route('posts.index')
                ->with('alert','Post Deleted successfuly')
                ->with('accent','Done')
                ->with('type','success');;
    }

}
