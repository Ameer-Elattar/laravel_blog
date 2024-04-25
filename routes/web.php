<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/posts', [PostController::class, "index"]);
// Route::get('/posts/create', [PostController::class, "create"]);
// Route::post('/posts', [PostController::class, "store"]);
// Route::get('/posts/{id}', [PostController::class, "show"]);
// Route::get('/posts/{id}/edit', [PostController::class, "edit"]);
// Route::put('/posts/{id}', [PostController::class, "update"]);
// Route::delete("/posts/{id}", [PostController::class,"destroy"]);

// Route::resource('posts', PostController::class)->except([
//   'create', 'store', 'edit', 'update', 'destroy'
// ]);


Route::redirect('/', '/login');
Route::resource('posts', PostController::class);
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    // dd($githubUser);
    $name = $githubUser->name ?? $githubUser->nickname ??'Unknown'; 

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ],[
        'name' => $name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

  

    Auth::login($user);

    return redirect('/posts');
});


