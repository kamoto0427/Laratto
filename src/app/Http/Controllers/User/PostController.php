<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

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
        return view('user.list.index', compact(
            'posts',
        ));
    }

    /**
     * 記事投稿画面
     * 
     * @return Response src/resources/views/user/list/create.blade.phpを表示
     */
    public function create()
    {
        // カテゴリーデータを全件取得
        $categories = $this->category->getAllCategories();
        return view('user.list.create', compact(
            'categories',
        ));
    }

    /**
     * 記事投稿処理
     * 
     * @param string $request リクエストデータ
     * @return Response src/resources/views/user/list/index.blade.phpを表示
     */
    public function store(Request $request)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        switch (true) {
            // 下書き保存クリック時の処理
            case $request->has('save_draft'):
                $this->post->insertPostToSaveDraft($user_id, $request);
                break;
            // 公開クリック時の処理
            case $request->has('release'):
                $this->post->insertPostToRelease($user_id, $request);
                break;
            // 予約公開クリック時の処理
            case $request->has('reservation_release'):
                $this->post->insertPostToReservationRelease($user_id, $request);
                break;
            // 上記以外の処理
            default:
                $this->post->insertPostToSaveDraft($user_id, $request);
                break;
        }

        return to_route('user.index', ['id' => $user_id]);
    }
}
