<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function AuthorizeAdminOrOwner(User $user){
        if(
            Auth::user()->id !== $user->id
            && !Auth::user()->is_admin
        ) abort(403);
    }
    public function index(Request $request)
    {
        // when add a condition to apply a query when it's true
        // use to import the variable $req to the anonymous function
        $users = User::when($request->filled('q'), function($query) use ($request){
            $query->where('id', $request->q)
                ->orWhere('username', 'LIKE', "%" . $request->q . "%")
                ->orWhere('name', 'LIKE', "%" . $request->q . "%")
                ->orWhere('email', 'LIKE', "%" . $request->q . "%")
                ->orWhere('bio', 'LIKE', "%" . $request->q . "%");
        })
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        $total = User::count();

        return view('users.index', compact('users','total'));
    }

    public function show(User $user)
    {
        $total = Post::where('id',$user->id)->count();
        $post = Post::where('id',$user->id)->orderByDesc('id')->get();
        return view('users.show' , compact('user','post','total'));
    }

    public function edit(User $user)
    {
        $this->AuthorizeAdminOrOwner($user);
        return view('users.edit',compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $this->AuthorizeAdminOrOwner($user);
        $validated = $request->validated();
        
        if(empty($validated['password'])) unset($validated['password']);
        if(isset($validated['profile'])){
            if($user->profile_path !== 'users/default-profile.png'){
                Storage::disk('public')->move(
                    $user->profile_path,
                    'users/trash/' . basename($user->profile_path)
                );
            }
            $validated['profile_path'] = $request->file('profile')->store('users','public');
        }
        $user->update($validated);

        return to_route('users.show', $user->id)
                ->with('alert','User Updated successfuly')
                ->with('accent','Done')
                ->with('type','success'); 

    }

    public function destroy(User $user)
    {
        $this->AuthorizeAdminOrOwner($user);

        $UserPosts = Post::where('user_id',$user->id)->get('image_path');
        foreach($UserPosts as $post){
            $path = $post->image_path;
            if($path != 'posts/post-no-image.png'){
                Storage::disk('public')->move(
                    $path,
                    'posts/trash/' . basename($path)
                );
            }
        } 
        if($user->profile_path){
            Storage::disk('public')->move(
                $user->profile_path,
                'users/trash/' . basename($user->profile_path)
            );
        }

        Post::where('user_id',$user->id)->delete();
        $user->delete();

        return to_route('users.index')
                ->with('alert','User Deleted successfuly')
                ->with('accent','Done')
                ->with('type','success');;
    }
}
