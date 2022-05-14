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
}
