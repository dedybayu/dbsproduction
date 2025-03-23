<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterControler;
use App\Models\Category;
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

Route::delete('/data/{id}', [PostsController::class, 'destroy'])->name('data.destroy');

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



Route::middleware(['auth'])->group(function () {
    Route::get('/posts/{slug}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{slug}', [PostsController::class, 'update'])->name('posts.update');
    
    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });
});



Route::resource('/categories', AdminCategoryController::class)
    ->except('show');
Route::post('/categories', [AdminCategoryController::class, 'store']);
Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
// Route::get('/categories/{id}', [AdminCategoryController::class, 'edit']);
// Route::put('/categories/{id}', [AdminCategoryController::class, 'update']);


Route::resource('/users', AdminUsersController::class)
    ->except('show');
Route::post('/users', [AdminUsersController::class, 'store']);
Route::delete('/users/{id}', [AdminUsersController::class, 'destroy'])->name('users.destroy');



Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::get('/edit', [ProfileController::class, 'viewEditUser']);
    Route::put('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/{id}/update_password', [ProfileController::class, 'update_password'])->name('profile.update_password');
    Route::put('/profile/{id}/update_password', [ProfileController::class, 'update_password'])->name('profile.update_password');
})->middleware('auth');

Route::get('/get-categories', function () {
    return response()->json(Category::all()); // Ambil semua data tanpa pagination
});


Route::get('/users/{id}/edit', [AdminUsersController::class, 'edit'])->name('user.edit');
Route::put('/users/update/{id}', [AdminUsersController::class, 'update'])->name('user.update');

Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');

