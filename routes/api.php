<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::apiResource('v1/users', UserController::class)
    ->names([
        'index' => 'api.users.index',
        'show' => 'api.users.show',
        'store' => 'api.users.store',
        'update' => 'api.users.update',
        'destroy' => 'api.users.destroy'
    ]);
Route::apiResource('v1/posts', PostController::class)
    ->names([
        'index' => 'api.posts.index',
        'show' => 'api.posts.show',
        'store' => 'api.posts.store',
        'update' => 'api.posts.update',
        'destroy' => 'api.posts.destroy'
    ]);