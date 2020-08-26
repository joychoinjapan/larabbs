<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => 'シェア',
                'description' => 'ノーハウをシェア'
            ],
            [
                'name' => 'コース',
                'description' => '開発の技術を教える'
            ],
            [
                'name' => '質問回答',
                'description' => 'お互いに助け合い'
            ],
            [
                'name' => 'お知らせ',
                'description' => '運営のお知らせ'
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
