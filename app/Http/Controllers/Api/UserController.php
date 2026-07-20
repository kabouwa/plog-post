<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->filled('q'), function($query) use ($request){
            $query->where('id', $request->q)
                ->orWhere('username', 'LIKE', "%" . $request->q . "%")
                ->orWhere('name', 'LIKE', "%" . $request->q . "%")
                ->orWhere('email', 'LIKE', "%" . $request->q . "%")
                ->orWhere('bio', 'LIKE', "%" . $request->q . "%");
        })
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();
        return UserResource::collection($users);
    }

    public function show(User $user) 
    {   
        return new UserResource($user);
    }

    public function store(RegisterRequest $request) 
    {
        $validated = $request->validated();
        $status = 201;
        $user = User::create($validated);
        $data = new UserResource($user);
        return response()->json($data,$status);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        foreach($validated as $key => $val){
            if($val && $key !== 'profile'){
                $user->$key = $val;
            }
        }
        $user->save();
        return new UserResource($user);
    }
    
    public function destroy(User $user) 
    {
        $UserPosts = $user->posts;
        foreach($UserPosts as $post){
            $path = $post->image_path;
            if($path != 'posts/post-no-image.png'){
                Storage::disk('public')->move(
                    $path,
                    'posts/trash/' . basename($path)
                );
            }
        }
        $profile = $user->profile_path;
        if($profile && $profile  !== 'users/default-profile.png'){
            Storage::disk('public')->move(
                $user->profile_path,
                'users/trash/' . basename($user->profile_path)
            );
        } 
        $user->posts()->delete();
        $user->comments()->delete();
        $user->delete();
        return response()->json(null,204);
    }
}
