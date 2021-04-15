<?php

use App\Models\Temporality;
use Illuminate\Database\Seeder;

class TemporalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // temp 1
        Temporality::create([
            'start_at'      => "2021-02-01 00:00:00", 
            'finish_at'     => "2021-02-07 23:59:59",
            'number'        => 1
        ]);

        // temp 2
        Temporality::create([
            'start_at'      => "2021-02-08 00:00:00", 
            'finish_at'     => "2021-02-14 23:59:59",
            'number'        => 2
        ]);

        // temp 3
        Temporality::create([
            'start_at'      => "2021-02-15 00:00:00", 
            'finish_at'     => "2021-02-21 23:59:59",
            'number'        => 3
        ]);

        // temp 4
        Temporality::create([
            'start_at'      => "2021-02-22 00:00:00", 
            'finish_at'     => "2021-02-28 23:59:59",
            'number'        => 4
        ]);
    }
}
