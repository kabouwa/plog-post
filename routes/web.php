<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;


date_default_timezone_set('Africa/Casablanca');
Route::get(uri : '/', action : function(){
    return to_route("posts.index");
});

//Posts

Route::get(uri : '/posts',             action : [PostsController::class, 'index'  ])->name('posts.index');

Route::get(uri : '/posts/create',      action : [PostsController::class, 'create' ])->name('posts.create');

Route::post(uri : '/posts',            action : [PostsController::class, 'store'  ])->name('posts.store');

Route::get(uri : '/posts/{post}',      action : [PostsController::class, 'show'   ])->name('posts.show');

Route::get(uri : '/posts/{post}/edit', action : [PostsController::class, 'edit'   ])->name('posts.edit');

Route::put(uri : '/posts/{post}',      action : [PostsController::class, 'update' ])->name('posts.update');

Route::delete(uri : '/posts/{post}',   action : [PostsController::class, 'destroy'])->name('posts.destroy');