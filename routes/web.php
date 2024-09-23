<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
Route::resource('comments', CommentController::class);

Route::get('/create', [PostController::class, 'create']);

//Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
