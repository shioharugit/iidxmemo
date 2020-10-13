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
                    'version' => '7',
                    'title' => 'A',
                    'genre' => 'RENAISSANCE',
                    'artist' => 'D.J.Amuro',
                    'bpm' => '93-191',
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
                    'version' => '26',
                    'title' => 'A Tale Hidden In The Abyss',
                    'genre' => 'COMMENT OUT',
                    'artist' => 'BEMANI Sound Team "person09"',
                    'bpm' => '216',
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
                    'version' => '11',
                    'title' => 'AA',
                    'genre' => 'RENAISSANCE',
                    'artist' => 'D.J.Amuro',
                    'bpm' => '154',
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
