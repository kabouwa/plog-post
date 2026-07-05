<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{   
    // Create login form
    public function create(){
        return view('auth.login');
    }
    
    // Store auth session
    public function store(Request $request){
        // Get credentials from form
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string']
        ]);

        // Attemp login (SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1;)
        if(Auth::attempt($credentials)){
            // if Success generate new session id in purpose to kept data of authenticated user
            $request->session()->regenerate();
            // Redirect to the page which request the user before auth or by default posts
            return redirect()->intended('posts');
        }


        // Redirect back to login page with custom errors and preserve just username value
        return back()->withErrors([
            'auth' => 'Invalid username or password.'
        ])->onlyInput('username');
    }

    public function destroy(Request $request){
        // Log out
        Auth::logout();
        // Invalidate session 
        $request->session()->invalidate();
        // Generate new session token 
        $request->session()->regenerateToken();
        
        return to_route('login')
        ->with('success', 'You have been logged out successfully.');
    }
}
