<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert(
            [
                [
                    'login_id' => 'iidxmemo_user',
                    'email' => 'iidxmemo_user@example.com',
                    'email_verified_at' => '2020-10-06 00:00:00',
                    'password' => password_hash('password', PASSWORD_BCRYPT),
                    'deleted_at' => null,
                ],
                [
                    'login_id' => 'iidxmemo_user2',
                    'email' => 'iidxmemo_user2@example.com',
                    'email_verified_at' => '2020-10-06 00:00:00',
                    'password' => password_hash('password', PASSWORD_BCRYPT),
                    'deleted_at' => '2020-10-06 00:00:00',
                ],
                [
                    'login_id' => 'iidxmemo_user3',
                    'email' => 'iidxmemo_user3@example.com',
                    'email_verified_at' => '2020-10-06 00:00:00',
                    'password' => password_hash('password', PASSWORD_BCRYPT),
                    'deleted_at' => null,
                ]
            ]
        );
    }
}
