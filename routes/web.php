<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


date_default_timezone_set('Africa/Casablanca');
Route::get(uri : '/', action : function(){
    return to_route("posts.index");
});


// Login - logout
Route::get(uri : '/login',             action : [LoginController::class,'create'    ])->name('login')   ->middleware('guest');
Route::post(uri : '/login',            action : [LoginController::class,'store'     ])->middleware('guest');
Route::post(uri : '/logout',           action : [LoginController::class,'destroy'   ])->name('logout')  ->middleware('auth');

// Register
Route::get(uri : '/register',          action : [RegisterController::class,'create' ])->name('register')->middleware('guest');
Route::post(uri : '/register',         action : [RegisterController::class,'store'  ])->middleware('guest');


// Users - Without grouping Routes
Route::get(uri : '/users',             action : [UserController::class, 'index'  ])->name('users.index');

Route::get(uri : '/users/{user}',      action : [UserController::class, 'show'   ])->name('users.show')->where('user','\d+');

Route::get(uri : '/users/{user}/edit', action : [UserController::class, 'edit'   ])->name('users.edit')->where('user','\d+');

Route::put(uri : '/users/{user}',      action : [UserController::class, 'update'   ])->name('users.update')->where('user','\d+');

Route::delete(uri : '/users/{user}',   action : [UserController::class, 'destroy'])->name('users.destroy')->where('user','\d+');


//Posts - With grouping routes
// Route::prefix('posts')->name('posts.')->group(function(){
//     Route::controller(PostController::class)->group(function(){
//         Route::get(uri : '/',            action : 'index'  )->name('index');
        
//         Route::get(uri : '/create',      action : 'create' )->name('create');
        
//         Route::post(uri : '/',           action : 'store'  )->name('store');
        
//         Route::get(uri : '/{post}',      action : 'show'   )->name('show'); // where not important if the route bind with modal (Post $post)
        
//         Route::get(uri : '/{post}/edit', action : 'edit'   )->name('edit');
        
//         Route::put(uri : '/{post}',      action : 'update' )->name('update');
        
//         Route::delete(uri : '/{post}',   action : 'destroy')->name('destroy');
//         // '/posts/{post:title}' to change default key in uri :nameColumn
//     });
// });
/**
 * IF WE HAVE THE 7 METHODS (index/show/create/store/edit/update/destroy) IN OUR CONTROLLER. THEN THIS CONTROLLER IS A RESOURCE.
 * WE SET UP ALL THEIR ROUTE IN ONE LINE WITH THE STATIC METHOD resource IN THE CLASS Routes
 */
Route::resource('posts',PostController::class);



/**
 * REST API:
 */
Route::get(uri : '/api/v1/users',   action : [ App\Http\Controllers\Api\UserController::class, 'index' ]);
Route::get(uri : '/api/v1/posts',   action : [ App\Http\Controllers\Api\PostController::class, 'index' ]);