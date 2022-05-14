<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\ReservationPost;
use Illuminate\Support\Facades\Auth;

class ReservationPostController extends Controller
{
    private $post;
    private $category;
    private $reservationPost;

    public function __construct()
    {
        $this->post = new Post();
        $this->category = new Category();
        $this->reservationPost = new ReservationPost();
    }

    /**
     * 予約公開設定画面
     *
     * @param int $post_id 投稿ID
     */
    public function reservationSetting(Request $request)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();
        // ログインユーザーIDを取得
        $user_id = $user->id;

        // 取得したリクエストデータを変数にセット
        $title = $request->title;
        $body  = $request->body;
        $category = $request->category;

        // 15分リスト
        $minuteList = ['00', '15', '30', '45'];

        // 予約設定画面を返す
        return view('user.list.reservationSetting', compact(
            'user_id',
            'title',
            'body',
            'category',
            'minuteList'
        ));
    }
}
