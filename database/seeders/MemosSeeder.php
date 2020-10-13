<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memos')->truncate();
        DB::table('memos')->insert(
            [
                [
                    'user_id' => 1,
                    'music_id' => 1,
                    'memo' => 'フルコンできそう'
                ],
                [
                    'user_id' => 1,
                    'music_id' => 3,
                    'memo' => 'スコア更新できそう'
                ],
            ]
        );
    }
}
