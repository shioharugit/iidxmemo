<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('musics')->truncate();
        DB::table('musics')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'A',
                    'popular_name' => 'エース',
                    'sp_beginner' => null,
                    'sp_normal' => 6,
                    'sp_hyper' => 10,
                    'sp_another' => 12,
                    'sp_leggendaria' => null,
                    'dp_normal' => 8,
                    'dp_hyper' => 11,
                    'dp_another' => 12,
                    'dp_leggendaria' => null,
                ],
                [
                    'id' => 2,
                    'name' => 'A Tale Hidden In The Abyss',
                    'popular_name' => null,
                    'sp_beginner' => null,
                    'sp_normal' => 6,
                    'sp_hyper' => 9,
                    'sp_another' => 11,
                    'sp_leggendaria' => null,
                    'dp_normal' => 6,
                    'dp_hyper' => 9,
                    'dp_another' => 11,
                    'dp_leggendaria' => null,
                ],
                [
                    'id' => 3,
                    'name' => 'AA',
                    'popular_name' => 'ダブルエース',
                    'sp_beginner' => null,
                    'sp_normal' => 5,
                    'sp_hyper' => 10,
                    'sp_another' => 12,
                    'sp_leggendaria' => null,
                    'dp_normal' => 5,
                    'dp_hyper' => 9,
                    'dp_another' => 12,
                    'dp_leggendaria' => null,
                ],
            ]
        );
    }
}
