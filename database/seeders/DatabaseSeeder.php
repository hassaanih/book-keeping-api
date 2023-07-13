<?php

namespace Database\Seeders;

use Database\Seeders\UserTableSeeder;
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
        $this->call([
            UsersTableSeeder::class,
            LookupCurrenciesTableSeeder::class,
            DashboardTableSeeder::class,
            UserCurrencyCreditTableSeeder::class
        ]);
    }
}
