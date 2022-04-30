<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\TrashController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// 総合トップ
Route::controller(TopController::class)->group(function() {
    // 総合トップ画面
    Route::get('/', 'top')
        ->name('top');
    // 総合トップ記事詳細画面
    Route::get('/article/{post_id}', 'articleShow')
        ->name('top.article.show');
    // 総合トップカテゴリーごとの記事一覧
    Route::get('/article/category/{category_id}', 'articleCategory')
        ->name('top.article.category');
});

// マイページ投稿関係
Route::controller(PostController::class)->group(function() {
    // マイページトップ・投稿
    Route::get('/user/{id}/index', 'index')
        ->name('user.index');

    // 投稿登録画面
    Route::get('/post/create', 'create')
        ->name('post.create');

    // 投稿登録処理
    Route::post('/post/store', 'store')
        ->name('post.store');

    // 投稿詳細
    Route::get('/post/show/{post_id}', 'show')
        ->name('post.show');

    // 記事編集
    Route::get('/post/edit/{post_id}', 'edit')
        ->name('post.edit');

    // 記事更新
    Route::post('/post/edit/{post_id}', 'update')
        ->name('post.update');

});

// ゴミ箱関係
Route::controller(TrashController::class)->group(function() {
    // 記事のゴミ箱
    Route::get('/post/trash', 'trashList')
        ->name('post.trash');

    // 記事論理削除(ゴミ箱に移動)
    Route::post('/post/trash/{post_id}', 'moveTrash')
        ->name('post.move.trash');

    // 記事の復元(ゴミ箱から投稿リストに戻す)
    Route::post('/post/restore/{post_id}', 'restore')
        ->name('post.restore');

    // 記事を完全に削除
    Route::post('/post/delete/{post_id}', 'delete')
        ->name('post.delete');
});
