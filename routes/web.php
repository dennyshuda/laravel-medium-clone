<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');
Route::get('/@{user:username}/about', [PublicProfileController::class, 'about'])->name('profile.about');
Route::get('/@{user:username}/lists', [PublicProfileController::class, 'lists'])->name('profile.lists');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('dashboard');

    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');

    Route::post('/follow/{user}', [FollowerController::class, 'followUnfollow'])->name('follow');
    Route::post('/like/{post}', [LikeController::class, 'like'])->name('like');

    Route::get('/category/{category}', [CategoryController::class, 'category'])->name('category');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
