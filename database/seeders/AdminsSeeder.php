<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert(
            [
                [
                    'login_id' => 'iidxmemo_admin',
                    'email' => 'iidxmemo_admin@example.com',
                    'email_verified_at' => '2020-10-06 00:00:00',
                    'password' => password_hash('password', PASSWORD_BCRYPT),
                ]
            ]
        );
    }
}
