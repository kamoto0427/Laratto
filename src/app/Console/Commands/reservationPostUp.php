<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\ReservationPost;
use Illuminate\Support\Facades\Log;

class reservationPostUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reservationPostUp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約公開設定した記事のアップ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // ログ開始
        Log::info('予約公開コマンドの実行開始');

        // 今日の日付を取得
        $now = Carbon::now();
        // 年を取得
        $year = $now->year;
        // 月を取得
        $month = $now->month;
        // 一桁の月なら05のように先頭に0をつける
        if ($month >= 0 && $month < 10) {
            $month = '0'.$month;
        }
        // 一桁の日なら05のように先頭に0をつける
        $day = $now->day;
        if ($day >= 0 && $day < 10) {
            $day = '0'.$day;
        }
        // 一桁の時なら05のように先頭に0をつける
        $hour = $now->hour;
        if ($hour >= 0 && $hour < 10) {
            $hour = '0'.$hour;
        }
        // 一桁の分なら05のように先頭に0をつける
        $minute = $now->minute;
        if ($minute >= 0 && $minute < 10) {
            $minute = '0'.$minute;
        }

        // データベースと比較できるように20220504のように整形する
        $date = $year.$month.$day;
        // データベースと比較できるように053200のように整形する
        $time = $hour.$minute.'00';

        // 予約公開設定(reservation_postsテーブル)から日付と時間が今よりも前のデータを取得
        $reservation_posts = ReservationPost::where([
            ['reservation_date', '<=', $date],
        ])
        ->get();

        // 予約記事を公開する
        foreach ($reservation_posts as $reservation_post) {
            $r_date = $reservation_post->reservation_date;
            $r_time = $reservation_post->reservation_time;

            // 今日よりも前の日付なら公開
            // 今日と日付が同じで、時間が現在より前なら公開
            // 上記以外は公開しない
            if ($r_date < $date ||
                $r_date === $date && $r_time < $time) {
                // 予約公開設定する記事のidを取得
                $post_id = $reservation_post->post_id;
                // 上記のidをもとに、postsテーブルから該当の記事を取得
                $post = Post::find($post_id);
                Log::debug('公開する記事'.$post);
                // 該当記事の公開設定フラグを1に更新(ステータス：公開)
                $update_post = $post->fill(['publish_flg' => 1])->save();
                Log::debug('記事のステータスを更新'.$update_post);
                // 予約公開設定データは不要なので削除
                $delete_reservation_post = $reservation_post->delete($post_id);
                Log::debug('予約記事の削除'.$delete_reservation_post);
            } else {
                return;
            }
        }

        Log::info('予約公開コマンドの実行終了');
    }
}
