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
            'start'         => '2021-02-01 00:00:00',
            'end'           => '2021-02-05 23:59:59'
        ]);

        Temporality::create([
            'name'          => 'Fase 2',
            'start'         => '2021-02-06 00:00:00',
            'end'           => '2021-02-12 23:59:59'
        ]);

        Temporality::create([
            'name'          => 'Fase 3',
            'start'         => '2021-02-13 00:00:00',
            'end'           => '2021-02-19 23:59:59'
        ]);

        Temporality::create([
            'name'          => 'Finalizado',
            'start'         => '2021-02-20 00:00:00',
            'end'           => '2021-10-20 23:59:59',
            'finalized'     => 1
        ]);
    }
}
