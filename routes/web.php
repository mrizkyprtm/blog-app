<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/posts/read/{post:slug}', [FrontPostController::class, 'show'])->name('posts.show');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::prefix('back')->name('back.')->group(function () {
    Route::resource('/posts', PostController::class);
  });

  Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
  Route::delete('posts/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';
