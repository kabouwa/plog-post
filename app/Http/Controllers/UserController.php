<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        return view('users.edit',compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'bio' => strlen($validated['bio']) ? $validated['bio'] : "No information."
        ];
        if ($request->filled('password')) $data['password'] = $validated['password'];

        $user->update($data);

        return to_route('users.show', $user->id)
                ->with('alert','User Updated successfuly')
                ->with('accent','Done')
                ->with('type','success'); 

    }

    public function destroy(User $user)
    {
        Post::where('user_id',$user->id)->delete();
        $user->delete();
        return to_route('users.index')
                ->with('alert','User Deleted successfuly')
                ->with('accent','Done')
                ->with('type','success');;
    }
}
