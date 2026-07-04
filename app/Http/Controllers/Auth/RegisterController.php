<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        // Validation
        $validated = $request->validate([
            'name'     => 'required|min:4|max:35',
            'email'    => 'required|min:10|max:100|email|unique:users',
            'username' => 'required|min:4|max:35|',
            // 'password' => ['required','min:8','max:100','confirmed', Password::min(8)->letters()->numbers()->symbols()],
            'password' => ['required','min:4','max:100','confirmed'],
            'password_confirmation' => 'required',
        ]);

        // Insert in database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'bio' =>  'No information.'
        ]);

        // Redirect to login
        return to_route('login')
            ->with('alert',' please login in your account.')
            ->with('accent','Account created successfully');
    }
}

