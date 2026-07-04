<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $total = User::count('id');
        $users = User::orderBy('username')
            ->paginate(25);

        return view('users.index', compact('users','total'));
    }
}
