<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // categoriesテーブルを指定
        $table = DB::table('categories');

        // 一時的に外部キー制約を外す→truncateする前にこれを実行しないと、seeder実行が失敗するため。(具体的には、postsのcategory_id_foreignのエラーがでる)
        Schema::disableForeignKeyConstraints();

        // シーダー実行前にcategoriesテーブルの中身を空にする
        $table->truncate();

        // 現在の日時を取得
        $now = Carbon::now();

        // データ
        $data = [
            ['category_name' => 'プレスリリース', 'created_at' => $now],
            ['category_name' => '機能', 'created_at' => $now],
            ['category_name' => 'アプリ開発', 'created_at' => $now],
            ['category_name' => 'コミュニティ', 'created_at' => $now],
        ];

        // categoriesテーブルにデータをinsert
        $table->insert($data);

        // 外していた外部キー制約を戻す
        Schema::enableForeignKeyConstraints();
    }
}
