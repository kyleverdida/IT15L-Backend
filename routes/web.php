<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');