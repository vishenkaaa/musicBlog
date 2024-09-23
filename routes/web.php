<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
