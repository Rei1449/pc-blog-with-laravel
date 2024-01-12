<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('/try', [PostController::class, 'try'])->name('try');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/ranking', [PostController::class, 'ranking'])->name('ranking');

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class,'delete']);
});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('like.destroy');
    Route::get('/likes', [PostController::class, 'like_posts'])->name('likes');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/submitted', [PostController::class, 'submitted_posts'])->name('submitted');
});

require __DIR__.'/auth.php';
