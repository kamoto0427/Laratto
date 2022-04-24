<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // postsテーブルを指定
        $table = DB::table('posts');

        // シーダー実行前にpostsテーブルの中身を空にする
        $table->truncate();

        // 現在の日時を取得
        $now = Carbon::now();

        // データ
        $data = [
            [
                'user_id'     => 1,
                'category_id' => 1,
                'title'       => 'Laravel9に新たな機能が登場!',
                'body'        => '記事内容記事内容記事内容',
                'publish_flg' => 0,
                'view_counter' => 10,
                'favorite_counter' => 3,
                'delete_flg'  => 0,
                'created_at'  => $now,
                'updated_at'  => $now
            ],
            [
                'user_id'     => 1,
                'category_id' => 2,
                'title'       => 'Laravel10はいつ頃実装されるのか？',
                'body'        => '記事内容記事内容記事内容',
                'publish_flg' => 1,
                'view_counter' => 20,
                'favorite_counter' => 5,
                'delete_flg'  => 0,
                'created_at'  => $now,
                'updated_at'  => $now
            ],

            [
                'user_id'     => 1,
                'category_id' => 3,
                'title'       => 'Laravelのアプリ開発はどれほど効率的なのか？',
                'body'        => '記事内容記事内容記事内容',
                'publish_flg' => 2,
                'view_counter' => 40,
                'favorite_counter' => 15,
                'delete_flg'  => 0,
                'created_at'  => $now,
                'updated_at'  => $now
            ],
            [
                'user_id'     => 1,
                'category_id' => 4,
                'title'       => 'Laravelのコミュニティを作成しました',
                'body'        => '記事内容記事内容記事内容',
                'publish_flg' => 0,
                'view_counter' => 30,
                'favorite_counter' => 10,
                'delete_flg'  => 0,
                'created_at'  => $now,
                'updated_at'  => $now
            ],
        ];

        // postsテーブルにデータをinsert
        $table->insert($data);
    }
}
