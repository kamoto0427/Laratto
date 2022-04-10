<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }

    /**
     * 投稿リスト
     * 
     * @param int $id ユーザーID
     * @return Response src/resources/views/user/list/index.blade.phpを表示
     */
    public function index(int $id)
    {
        // ユーザーIDと一致する投稿データを取得
        $posts = $this->post->getAllPostsByUserId($id);

        // 投稿リストを返す
        return view('user.list.index', compact('posts'));
    }

    /**
     * 記事投稿画面
     */
    public function create()
    {
        // カテゴリーを全て取得
        $categories = $this->category->getAllCategories();

        // 新規画面を返す
        return view('user.list.create', compact('categories'));
    }

    /**
     * 記事投稿処理
     */
    public function store(PostRequest $request)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // 押下されたボタンに応じて下書き保存か公開か予約公開か決定し、postsテーブルにデータをinsert
        switch (true) {
            // 下書き保存クリック
            case $request->has('save_draft'):
                $this->post->insertPostToSaveDraft($user_id, $request);
                break;
            // 公開クリック
            case $request->has('release'):
                $this->post->insertPostToRelease($user_id, $request);
                break;
            // 予約公開クリック
            case $request->has('reservation_release'):
                $this->post->insertPostToReservationRelease($user_id, $request);
                break;
            // 上記以外ならば、下書き保存の処理
            default:
                $this->post->insertPostToSaveDraft($user_id, $request);
        }

        // マイページのトップ画面(投稿)にリダイレクト
        return to_route('user.index', ['id' => $user_id]);
    }
}
