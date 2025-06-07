<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::prefix('posts')->name('posts.')->group(function () {

    // 記事一覧
    Route::get('/', [PostController::class, 'index'])->name('index');

    // 記事作成フォーム
    Route::get('/create', [PostController::class, 'create'])->name('create');

    // 記事保存
    Route::post('/', [PostController::class, 'store'])->name('store');

    // 管理者用：全記事一覧（公開・非公開含む）
    Route::get('/admin', [PostController::class, 'admin'])->name('admin');

    // 記事詳細（スラッグベース）
    Route::get('/{slug}', [PostController::class, 'show'])->name('show');

    // 記事編集フォーム
    Route::get('/{slug}/edit', [PostController::class, 'edit'])->name('edit');

    // 記事更新
    Route::put('/{slug}', [PostController::class, 'update'])->name('update');

    // 記事削除
    Route::delete('/{slug}', [PostController::class, 'destroy'])->name('destroy');
});


/*
|--------------------------------------------------------------------------
| 生成されるルート一覧
|--------------------------------------------------------------------------
| GET    /                     → posts.index へリダイレクト
| GET    /posts                → posts.index    (記事一覧)
| GET    /posts/create         → posts.create   (作成フォーム)
| POST   /posts                → posts.store    (作成保存)
| GET    /posts/admin          → posts.admin    (管理画面)
| GET    /posts/{slug}         → posts.show     (詳細表示)
| GET    /posts/{slug}/edit    → posts.edit     (編集フォーム)
| PUT    /posts/{slug}         → posts.update   (更新保存)
| DELETE /posts/{slug}         → posts.destroy  (削除)
|--------------------------------------------------------------------------
*/