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

    /**
     * 記事の論理削除(ゴミ箱に移動)
     *
     * @param int $post_id 投稿ID
     */
    public function moveTrash($post_id)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);

        // 記事を論理削除(ゴミ箱に移動)
        $trashPost = $this->post->moveTrashPostData($post);

        // マイページ投稿リストにリダイレクト
        return to_route('user.index', ['id' => $user_id])->with('moveTrash', '記事をゴミ箱に移動しました。');
    }

    /**
     * 記事の復元
     *
     * @param int $post_id 投稿ID
     */
    public function restore($post_id)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // ユーザーIDをもとに、論理削除されているdelete_flg=1のデータを取得
        $trash_posts = $this->post->getTrashPostLists($user_id);

        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);

        // 記事の復元
        $restorePost = $this->post->restorePostData($post);

        // ゴミ箱にリダイレクト
        return to_route('post.trash', compact(
            'user_id',
            'trash_posts',
        ))
        ->with('restore', '記事を復元しました。');
    }

    /**
     * 記事をゴミ箱から削除(物理削除なので、完全にデータを削除する)
     *
     * @param int $post_id 投稿ID
     */
    public function delete($post_id)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // ユーザーIDをもとに、論理削除されているdelete_flg=1のデータを取得
        $trash_posts = $this->post->getTrashPostLists($user_id);

        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);

        // 記事を物理削除(ゴミ箱からも削除)
        $deletePost = $this->post->deletePostData($post);
        // ゴミ箱にリダイレクト
        return to_route('post.trash', compact(
            'user_id',
            'trash_posts',
        ))
        ->with('delete', '記事を完全に削除しました。');
    }
}
