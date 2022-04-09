<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('user.list.index', compact('posts'));
    }

    /**
     * 記事投稿画面
     */
    public function create()
    {
        $categories = $this->category->getAllCategories();
        return view('user.list.create', compact('categories'));
    }

    /**
     * 記事投稿処理
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $insert_post = $this->post->insertPostByRequestData($user_id, $request);

        return to_route('user.index', ['id' => $user_id]);
    }
}
