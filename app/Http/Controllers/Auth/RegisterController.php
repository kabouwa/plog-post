<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(RegisterRequest $request){
        // Validation
        $validated = $request->validated();
        if(isset($validated['profile'])) $validated['profile_path'] = $request->file('profile')->store('users','public');

        // Insert in database
        User::create($validated);

        // Redirect to login
        return to_route('login')
            ->with('alert',' please login in your account.')
            ->with('accent','Account created successfully');
    }
}

