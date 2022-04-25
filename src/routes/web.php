<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\User\PostController;

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
Route::get('/', [TopController::class, 'top'])
    ->name('top');

// 総合トップ記事詳細画面
Route::get('/article/{post_id}', [TopController::class, 'articleShow'])
    ->name('top.article.show');

// 総合トップカテゴリーごとの記事一覧
Route::get('/article/category/{category_id}', [TopController::class, 'articleCategory'])
    ->name('top.article.category');

// マイページトップ・投稿
Route::get('/user/{id}/index', [PostController::class, 'index'])
    ->name('user.index');

// 投稿登録画面
Route::get('/post/create', [PostController::class, 'create'])
    ->name('post.create');

// 投稿登録処理
Route::post('/post/store', [PostController::class, 'store'])
    ->name('post.store');

// 投稿詳細
Route::get('/post/show/{post_id}', [PostController::class, 'show'])
    ->name('post.show');
