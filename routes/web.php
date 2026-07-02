<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


date_default_timezone_set('Africa/Casablanca');
Route::get(uri : '/', action : function(){
    return to_route("posts.index");
});


// Authentication
Route::get(uri : '/login',             action : [LoginController::class,'login'        ])->name('login')->middleware('guest');
Route::post(uri : '/login',            action : [LoginController::class,'authenticate' ])->name('authenticate')->middleware('guest');
Route::get(uri : '/logout',            action : [LoginController::class,'logout'       ])->name('logout');


// Route::get(uri : '/register',          action : [RegisterController::class,'create'   ])->name('auth.register');


//Posts

Route::get(uri : '/posts',             action : [PostController::class, 'index'  ])->name('posts.index');

Route::get(uri : '/posts/create',      action : [PostController::class, 'create' ])->name('posts.create')->middleware('auth');

Route::post(uri : '/posts',            action : [PostController::class, 'store'  ])->name('posts.store')->middleware('auth');

Route::get(uri : '/posts/{post}',      action : [PostController::class, 'show'   ])->name('posts.show');

Route::get(uri : '/posts/{post}/edit', action : [PostController::class, 'edit'   ])->name('posts.edit')->middleware('auth');

Route::put(uri : '/posts/{post}',      action : [PostController::class, 'update' ])->name('posts.update')->middleware('auth');

Route::delete(uri : '/posts/{post}',   action : [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');