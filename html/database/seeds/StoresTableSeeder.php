<?php

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'store' => 'No aplica'
        ]);

        Store::create([
            'store' => 'Chedrahui'
        ]);
    }
}
