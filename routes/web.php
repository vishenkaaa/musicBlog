<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
Route::resource('comments', CommentController::class);
Route::resource('likes', LikeController::class);

Route::get('/create', [PostController::class, 'create']);
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like'); // Для додавання лайка
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike'); // Для видалення лайка
