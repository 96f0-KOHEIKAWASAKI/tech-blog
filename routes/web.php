<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// 公開ルート（認証不要）
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// 認証ルート
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/dashboard', [App\Http\Controllers\Auth\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// 認証が必要なルート（記事管理） - 詳細より前に配置
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// 記事詳細（最後に配置）
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
