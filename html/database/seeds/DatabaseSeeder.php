<?php

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
        // $this->call(UserSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(DailyticketsSeeder::class);
        $this->call(TemporalitiesTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StoresTableSeeder::class);
    }
}
