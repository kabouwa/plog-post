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

        // Insert in database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'bio' =>  'No information.'
        ]);

        // Redirect to login
        return to_route('login')
            ->with('alert',' please login in your account.')
            ->with('accent','Account created successfully');
    }
}

