<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;

class TrashController extends Controller
{
    private $post;
    private $category;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
    }

    /**
     * ゴミ箱一覧
     *
     * @return Response src/resources/views/user/list/trash.blade.phpを表示
     */
    public function trashList()
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // ユーザーIDをもとに、論理削除されているdelete_flg=1のデータを取得
        $trash_posts = $this->post->getTrashPostLists($user_id);
        return view('user.list.trash', compact(
            'user_id',
            'trash_posts',
        ));
    }
}
