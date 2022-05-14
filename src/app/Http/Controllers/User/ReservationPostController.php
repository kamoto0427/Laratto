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

    /**
     * 予約公開設定
     *
     * @param $request リクエストデータ
     */
    public function reservationStore(Request $request)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // 投稿データをpostsテーブルにinsert
        $post = $this->post->insertPostToReservationRelease($user_id, $request);

        // 画面で入力した予約設定_日付を取得
        $date = $request->reservation_date;
        // リクエストが2022-04-30とくるので、20220430に整形
        $reservation_date = str_replace('-', '', $date);
        // 画面で入力した予約時間_時を取得
        $hour = $request->reservation_hour;
        // 画面で入力した予約時間_分を取得
        $minute = $request->reservation_minute;
        // 予約時間_時と予約時間_分を合体し、末尾に00をつけてデータを整形。ex.173100
        $reservation_time = $hour.$minute.'00';
        // 予約公開設定内容をreservation_postsテーブルにinsert
        $reservationPost = $this->reservationPost->insertReservationPostData(
            $post,
            $reservation_date,
            $reservation_time
        );

        // セッションにフラッシュメッセージを保存
        $request->session()->flash('reservationRelease', '記事を予約公開しました。');

        // 記事一覧画面にリダイレクト
        return to_route('user.index', ['id' => $user_id]);
    }
}
