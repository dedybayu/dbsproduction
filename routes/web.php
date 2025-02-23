<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterControler;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


//Halaman Pertama
Route::get('/', function () {
    return Auth::check()
        ? app(DashboardController::class)->index() //Auth
        : app(HomeController::class)->index(); //Guest
});


Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index']);
    Route::get('/{post:slug}', [PostsController::class, 'post']);
});

Route::get('/myposts', [PostsController::class, 'myPosts'])->middleware('auth');

Route::get('/create', [PostsController::class, 'createPost'])->middleware('auth');
Route::post('/create', [PostsController::class, 'store']);


Route::get('/about', function () {
    return view('about', ['title' => 'About', 'name' => 'Bayu Setiawan']);
})->middleware('guest');;

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
})->middleware('guest');;

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterControler::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterControler::class, 'store']);



