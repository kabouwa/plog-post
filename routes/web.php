<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Cookie;

date_default_timezone_set('Africa/Casablanca');
Route::get(uri : '/', action : function(){
    return to_route("posts.index");
});


// * Login - logout - unique middleware
Route::get(uri  : '/login',            action : [LoginController::class,'create'    ])->name('login')   ->middleware('guest');
Route::post(uri : '/login',            action : [LoginController::class,'store'     ])                  ->middleware('guest');
Route::post(uri : '/logout',           action : [LoginController::class,'destroy'   ])->name('logout')  ->middleware('auth');

// * Register - grouping middleware
Route::middleware('guest')->group(function (){
    Route::get(uri : '/register',          action : [RegisterController::class,'create' ])->name('register');
    Route::post(uri : '/register',         action : [RegisterController::class,'store'  ]);
});


// * Users - Without grouping Routes
Route::get(uri : '/users',             action : [UserController::class, 'index'  ])->name('users.index');

Route::get(uri : '/users/{user}',      action : [UserController::class, 'show'   ])->name('users.show');

Route::get(uri : '/users/{user}/edit', action : [UserController::class, 'edit'   ])->name('users.edit')    ->middleware('auth');

Route::put(uri : '/users/{user}',      action : [UserController::class, 'update'   ])->name('users.update')->middleware('auth');

Route::delete(uri : '/users/{user}',   action : [UserController::class, 'destroy'])->name('users.destroy') ->middleware('auth');

// * Users Represent a resource so we can create their route simply with :
// Route::resource('users',UserController::class)->only(['index','show','edit','update','destroy']);






// * Posts - With grouping routes middlewares in controller (BEST PRACTICE)

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
Route::resource('comments',CommentController::class)->only(['store','update','destroy']);





/**
 * * Optional Arguments and responses
 */
Route::get('/age/{age?}' , function($age = null){
    return $age ? 'Your Age is : ' . $age : "No age is set !";
})->where('age','\d+');

/**
 * * Route Information
*/
Route::prefix('route')->get('info' , function(){
    dd(
        Route::current(),
        "Route Name : " . Route::currentRouteName(),
        "Route Action : " . (Route::currentRouteAction() ?? "Null"), // null - no controller method or callback function name
    );
})->name('route.info');
/**
 * * Outside Redirection
*/
Route::get('wikipedia' , function(){
    return redirect()->away('https://www.wikipedia.org/');
});
/**
 * * Dependicie Injection
 * create object in parameter instead of instance a new class
 */
Route::get('request', function(Request $request){ //
    // $request = new Request();
    return "Dependicie Injection" ;
});
/**
 * * Request - Response :
 * TEST URI : /input?id=53&name=Mohammed%20kabouwa&checkbox=true&date=7-7-2026
 */
Route::get('input', function(Request $request){
    // Request
    $id = $request->integer('id');
    $name = $request->string('name')->upper();
    $date = $request->date('date')->addDays(20);
    $checkbox = $request->float('checkbox');
    $has = $request->has('file') ? 'Yes' : 'No';
    $hasAny = $request->hasAny(['id','name']) ? 'Yes' : 'No';
    $request->whenhas(['id','name'], function(){
        echo '<h1>Request has The field ID AND NAME</h1>';
    });
    $responseHtml =  "
Id : $id <br>
Name : $name <br>
Date : $date <br>
Checkbox: $checkbox <br>
Uploaded File : $has <br>
Request has field (id || name) : $hasAny <br>
";
    // Response
   return new Response(content : $responseHtml , status : 500);
});
/**
 * * Download - Read Files
 */
Route::prefix('download')->get('profile', function(){
    // Display
    // return response()->file(
    //     file : 'storage/users/default-profile.png',
    // );
    // Download - and show
    return response()->download(
        file : 'storage/users/default-profile.png',
        name : 'profile',
        disposition  : 'inline' // to show
    );
});
/**
 * * Cookies
 */
Route::prefix('cookie')->group(function (){
    Route::get('get/{name}', function($name, Request $request){
        $cookie = $request->cookie($name);
        return 'The requested cookie is : ' . htmlspecialchars($cookie);
    })->where('name','[a-zA-z0-9]+');

    Route::get('set/{name}/{value}', function($name, $value){
        $newCookie = cookie($name, $value, 60);
        return response("The cookie with name : " . htmlspecialchars($name). " is set with the value " . htmlspecialchars($value) )->withCookie($newCookie);
    })->where('name','[a-zA-z0-9]+')->where('value','[a-zA-z0-9]+');

    Route::get('unset/{name}', function($name, Request $request){
        return response("The cookie w is deleted successffuly !")
            ->withCookie(Cookie::forget($name));
    })->where('name','[a-zA-z0-9]+');

});
/**
 * * Requests - Headers Get and set
 */
Route::get('/headers',function(Request $r){
    $data = [
        'message' => 'request accepted',
        // Get headers
        // 'headers' => $request->header(),
        // 'Method' => $request->header('Request Method'),
        // 'Authorization' => $request->header('Authorization'),
        // 'Accept' => $request->header('Accept'),
        // 'User-Agent' => $request->header('User-Agent'),


        // Get request info
        'host' => $r->host(),
        'full-url' => $r->fullUrl(),
        'url' => $r->url(),
        'pathname' => $r->path(),
        'is-GET-method' => $r->isMethod('GET'),
        'is-POST-method' => $r->isMethod('POST'),
        'filled-name-query' => $r->filled('name'),
        'is-secure' => $r->isSecure(),
        'query' => $r->query(),
        'route-is' => $r->routeIs('headers'),
        'bearer-token' => $r->bearerToken()
    ];

    return new Response(content : $data, status : 203, headers :  [
        // -- Examples of setting Headers --
        // Type of response
        'Content-Type' => 'text/plain', // 'text/html - 'image/png' - 'application/json'
        // Set Cookies
        'Set-Cookie' => 'name=mohammed',
        // Specifiy origins allowed to request
        'Access-Control-Allow-Origin' => 'http://127.0.0.1:5500',
        // Custom headers
        'X-USER' => 'ADMIN',
    ]);
})->name('headers');



/**
 * REST API:
 */
Route::get(uri : '/api/v1/users',   action : [ App\Http\Controllers\Api\UserController::class, 'index' ]);
Route::get(uri : '/api/v1/posts',   action : [ App\Http\Controllers\Api\PostController::class, 'index' ]);
