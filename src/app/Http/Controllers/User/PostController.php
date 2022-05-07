<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\ReservationPost;
use App\Http\Requests\PostRequest;

class PostController extends Controller
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
    public function store(PostRequest $request)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        switch (true) {
            // 下書き保存クリック時の処理
            case $request->has('save_draft'):
                $this->post->insertPostToSaveDraft($user_id, $request);
                $request->session()->flash('saveDraft', '記事を下書きで保存しました。');
                break;
            // 公開クリック時の処理
            case $request->has('release'):
                $this->post->insertPostToRelease($user_id, $request);
                $request->session()->flash('release', '記事を公開しました。');
                break;
            // 上記以外の処理
            default:
                $this->post->insertPostToSaveDraft($user_id, $request);
                $request->session()->flash('saveDraft', '記事を下書きで保存しました。');
                break;
        }

        // 投稿一覧にリダイレクト
        return to_route('user.index', ['id' => $user_id]);
    }

    /**
     * 記事詳細
     *
     * @param int $post_id 投稿ID
     * @return Response src/resources/views/user/list/show.blade.phpを表示
     */
    public function show($post_id) {
        // リクエストされた投稿IDをもとにpostsテーブルから一意のデータを取得
        $showPostData = $this->post->feachPostDateByPostId($post_id);
        return view('user.list.show', compact(
            'showPostData',
        ));
    }

    /**
     * 記事編集
     *
     * @param int $post_id 投稿ID
     * @return Response src/resources/views/user/list/edit.blade.phpを表示
     */
    public function edit($post_id)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // カテゴリーデータを全件取得
        $categories = $this->category->getAllCategories();
        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);

        $date = null;
        $time = null;
        // 投稿IDをもとに予約公開データを取得
        $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
        if (isset($reservationPost)) {
            // 年・月・日にそれぞれ文字を切り出し
            // (20220530→2022)
            $year = substr($reservationPost->reservation_date, 0, 4);
            // (20220530→05)
            $month = substr($reservationPost->reservation_date, 4, 2);
            // (20220530→30)
            $day = substr($reservationPost->reservation_date, 6, 2);
            // 上記に年月日をつける(2022年05月30日)
            $date = $year.'年'.$month.'月'.$day;

            // 時・分にそれぞれ文字を切り出し
            // (083200→08)
            $hour = substr($reservationPost->reservation_time, 0, 2);
            // (083200→32)
            $minute = substr($reservationPost->reservation_time, 2, 2);
            // 上記に時・分をつける
            $time = $hour.'時'.$minute.'分';
        }

        return view('user.list.edit', compact(
            'categories',
            'post',
            'date',
            'time'
        ));
    }

    /**
     * 記事の更新
     *
     * @param int $post_id 投稿ID
     * @return Response src/resources/views/user/list/index.blade.phpを表示
     */
    public function update(PostRequest $request, $post_id)
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;

        // 投稿IDをもとに特定の投稿データを取得
        $post = $this->post->feachPostDateByPostId($post_id);

        switch (true) {
            // 下書き保存クリック時の処理
            case $request->has('save_draft'):
                // 記事のステータスを下書き(publish_flg=0)に更新
                $this->post->updatePostToSaveDraft($request, $post);
                // 投稿IDをもとに予約公開データを取得
                $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
                // 上記でもしデータがあれば、ステータスを下書きに戻すため予約公開データは不要のため削除する
                if (isset($reservationPost)) {
                    // 予約公開データの削除
                    $this->reservationPost->deleteData($reservationPost);
                }
                $request->session()->flash('updateSaveDraft', '記事を下書き保存で更新しました。');
                break;
            // 公開クリック時の処理
            case $request->has('release'):
                // 記事のステータスを公開(publish_flg=1)に更新
                $this->post->updatePostToRelease($request, $post);
                // 投稿IDをもとに予約公開データを取得
                $reservationPost = $this->reservationPost->getReservationPostByUserIdAndPostId($user_id, $post_id);
                // 上記でもしデータがあれば、ステータスを下書きに戻すため予約公開データは不要のため削除する
                if (isset($reservationPost)) {
                    // 予約公開データの削除
                    $this->reservationPost->deleteData($reservationPost);
                }
                $request->session()->flash('updateRelease', '記事を更新し公開しました。');
                break;
            // 上記以外の処理
            default:
                $this->post->updatePostToSaveDraft($request, $post);
                $request->session()->flash('updateSaveDraft', '記事を下書きで保存しました。');
                break;
        }

        return to_route('user.index', ['id' => $user_id]);
    }

    /**
     * 下書き保存一覧
     *
     * @return Response src/resources/views/user/list/saveDraft.blade.phpを表示
     */
    public function saveDraft()
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;
        // 下書き保存の記事一覧を取得
        $saveDrafts = $this->post->getSaveDraftPosts($user_id);
        return view('user.list.saveDraft', compact(
            'saveDrafts',
        ));
    }

    /**
     * 公開中記事一覧
     *
     * @return Response src/resources/views/user/list/release.blade.phpを表示
     */
    public function release()
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;
        // 公開中の記事一覧を取得
        $releases = $this->post->getReleasePosts($user_id);
        return view('user.list.release', compact(
            'releases',
        ));
    }

    /**
     * 予約公開記事一覧
     *
     * @return Response src/resources/views/user/list/release.blade.phpを表示
     */
    public function reservationRelease()
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();
        // ログインユーザー情報からユーザーIDを取得
        $user_id = $user->id;
        // 予約公開の記事一覧を取得
        $reservationPosts = $this->post->getReservationReleasePosts($user_id);
        return view('user.list.reservationRelease', compact(
            'reservationPosts',
        ));
    }
}
