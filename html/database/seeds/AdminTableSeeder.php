<?php

use Illuminate\Database\Seeder;

use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Ontwice',
            'email' => 'it@ontwice.com.mx',
            'superadmin' => true,
            'password' => bcrypt('Ontwice2020'),
        ]);
        Admin::create([
            'name' => 'Alvaro García',
            'email' => 'agarciat028@gmail.com',
            'superadmin' => true,
            'password' => bcrypt('Alvaro2021'),
        ]);
        Admin::create([
            'name' => 'Reportes',
            'email' => 'reportes@ontwice.com',
            'superadmin' => false,
            'password' => bcrypt('r3p0r7352021'),
        ]);
        Admin::create([
            'name' => 'L2A Admin 1',
            'email' => 'l2a_admin@prueba.com',
            'superadmin' => true,
            'password' => bcrypt('jKF37C3RSA'),
        ]);
    }
}
