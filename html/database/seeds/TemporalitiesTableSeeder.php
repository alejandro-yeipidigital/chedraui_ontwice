<?php

use Illuminate\Database\Seeder;

use App\Models\{Temporality};

class TemporalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // |-------------|
        // |---Pruebas---|
        // |-------------|
        Temporality::create([
            'name'          => 'Fase 1',
            'start'         => '2021-05-01 00:00:00',
            'end'           => '2021-05-07 23:59:59'
        ]);

        Temporality::create([
            'name'          => 'Finalizado',
            'start'         => '2021-05-08 00:00:00',
            'end'           => '2031-10-20 23:59:59',
            'finalized'     => 1
        ]);

        // Final
        // Temporality::create([
        //     'name'          => 'Fase 1',
        //     'start'         => '2021-05-17 00:00:00',
        //     'end'           => '2021-06-15 23:59:59'
        // ]);

        // Temporality::create([
        //     'name'          => 'Finalizado',
        //     'start'         => '2021-06-16 00:00:00',
        //     'end'           => '2031-10-20 23:59:59',
        //     'finalized'     => 1
        // ]);
    }
}
