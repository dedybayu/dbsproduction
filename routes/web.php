<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterControler;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index']);
    Route::get('/{post:slug}', [PostsController::class, 'post']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About', 'name' => 'Bayu Setiawan']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterControler::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterControler::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
