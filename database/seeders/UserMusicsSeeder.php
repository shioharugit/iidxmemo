<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMusicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_musics')->truncate();
        DB::table('user_musics')->insert(
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
