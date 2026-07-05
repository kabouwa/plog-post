<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
            ->paginate(2)
            ->withQueryString();

        $total = User::count();

        return [
            'users' => $users,
            'total_users' => $total,
        ];
    }
}
