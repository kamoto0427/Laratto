<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPost extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'reservation_posts';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'reservation_date',
        'reservation_time',
        'created_at',
        'updated_at'
    ];

    /**
     * 予約公開設定データをDBにinsert
     *
     * @param $post 投稿データ
     * @param $reservation_date 予約公開_日付
     * @param $reservation_time 予約公開_時間
     */
    public function insertReservationPostData($post, $reservation_date, $reservation_time)
    {
        return $this->create([
            'user_id' => $post->user_id,
            'post_id' => $post->id,
            'reservation_date' => $reservation_date,
            'reservation_time' => $reservation_time
        ]);
    }
}
