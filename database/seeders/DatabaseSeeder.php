<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ('production' !== config('app.env')) {
            $this->call(AdminsSeeder::class);
            $this->call(UsersSeeder::class);
            $this->call(MusicsSeeder::class);
            $this->call(MemosSeeder::class);
        }
    }
}
