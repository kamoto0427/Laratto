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

        // リクエストデータ
        $title = $request->title;
        $body  = $request->body;
        $category = $request->category;

        // 15分リスト
        $minuteList = ['00', '15', '30', '45'];

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
        return to_route('user.index', ['id' => $user_id]);
    }

    /**
     * 予約公開編集画面
     *
     * @param $request リクエストデータ
     * @param $post_id 投稿ID
     */
    public function reservationEdit(Request $request, $post_id)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();
        // ログインユーザーIDを取得
        $user_id = $user->id;

        // 投稿の編集画面で入力していた内容を取得
        $title = $request->title;
        $body  = $request->body;
        $category = $request->category;

        // 15分リスト
        $minuteList = ['00', '15', '30', '45'];

        // ユーザーIDと投稿IDをもとに、予約公開する投稿データを取得
        $post = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);

        // ①先頭から4文字目にハイフンをつける(ex.20220430→2022-0430)一度で二箇所にハイフンつけられないので2回に分けた
        $date = substr_replace($post->reservation_date, '-', 4, 0);
        // ②先頭から7文字目にハイフンをつける(ex.2022-0430→2022-04-30)
        $date = substr_replace($date, '-', 7, 0);

        // reservation_timeから時を切り出し(ex.174500→17)
        $hour = substr($post->reservation_time, 0, 2);
        // reservation_timeから分を切り出し(ex.174500→45)
        $minute = substr($post->reservation_time, 2, 2);
        return view('user.list.reservationEdit', compact(
            'user_id',
            'title',
            'body',
            'category',
            'minuteList',
            'post',
            'date',
            'hour',
            'minute'
        ));
    }

    /**
     * 予約公開設定更新
     *
     * @param $request リクエストデータ
     * @param $post_id 投稿ID
     */
    public function reservationUpdate(Request $request, $post_id)
    {
        // ログインユーザー情報を取得
        $user = Auth::user();
        // ログインユーザーIDを取得
        $user_id = $user->id;

        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);
        // 投稿データを更新
        $this->post->updatePostToReservationRelease($request, $post);

        // ユーザーIDと投稿IDをもとに更新する予約公開記事のデータを1件取得
        $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
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
        // 予約公開データを更新
        $this->reservationPost->updateReservationPost(
            $reservationPost,
            $reservation_date,
            $reservation_time
        );

        // セッションにフラッシュメッセージを格納
        $request->session()->flash('updateReservationRelease', '記事を予約公開で更新しました。');

        // 投稿一覧画面にリダイレクト
        return to_route('user.index', ['id' => $user_id]);
    }
}
