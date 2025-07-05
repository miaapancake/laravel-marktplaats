<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $postPaginator = Post::orderBy('created_at', 'desc')->paginate(50)->onEachSide(1);
    return view('posts.index', compact('postPaginator'));
})->name('welcome');

Route::get('/dashboard', function (Request $request) {
    $postsPaginator = $request->user()->posts()->paginate(5, ["*"], 'postsPage')->onEachSide(1);
    $bidsPaginator = $request->user()->offeredBids()->orderBy('created_at', 'desc')->paginate(5, ["*"], 'bidsPage')->onEachSide(1);

    return view('dashboard', compact('postsPaginator', 'bidsPaginator'));
})->middleware('auth')->name('dashboard');

Route::resource('/ads', PostController::class)->names('posts')->parameters([
    'ads' => 'post'
]);

Route::get('/search', function (Request $request) {

    $postPaginator = Post::search($request->query("query"))->paginate(50, 'page');


    return view('posts.index', compact('postPaginator'));
});

Route::resource('bids', BidController::class)->only(['store', 'destroy']);

Route::resource('categories', CategoryController::class)->only('show');

Route::resource('users', Controller::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'requestPassword'])->name('password.request');

Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
