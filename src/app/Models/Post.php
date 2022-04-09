<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Carbon;

class Post extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'publish_flg',
        'view_counter',
        'favorite_counter',
        'delete_flg',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ユーザーIDに紐づいた投稿リストを全て取得する
     * 
     * @param int $user_id ユーザーID
     * @return object $result App\Models\Post
     */
    public function getAllPostsByUserId($user_id)
    {
        $result = $this->where('user_id', $user_id)->with('category')->get();
        return $result;
    }

    /**
     * リクエストされたデータをpostsテーブルにinsertする
     * 
     * @param int $user_id ログインユーザーID
     * @param array $request リクエストデータ
     * @return object $result App\Models\Post
     */
    public function insertPostByRequestData($user_id, $request)
    {
        $result = $this->create([
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'body' => $request->body,
            'publish_flg' => 1,
            'view_counter' => 0,
            'favorite_counter' => 0,
            'delete_flg' => 0,
            'created_at' => Carbon::now(),
        ]);
        return $result;
    }
}
