<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;

class TopController extends Controller
{
    public function __construct()
    {
        $this->category = new Category();
        $this->post     = new Post();
    }

    /**
     * 総合トップ画面
     */
    public function top()
    {
        // ユーザーがログイン済み
        if (Auth::check()) {
            // 認証しているユーザーを取得
            $user = Auth::user();
            // 認証しているユーザーIDを取得
            $user_id = $user->id;
        } else {
            $user_id = null;
        }

        // カテゴリーを全て取得
        $categories = $this->category->getAllCategories();
        // 全ての投稿データを取得(publish_flgが公開のみ,最新更新日時順にソート)
        $posts = $this->post->getPostsSortByLatestUpdate();

        return view('top', compact(
            'user_id',
            'categories',
            'posts',
        ));
    }
}
