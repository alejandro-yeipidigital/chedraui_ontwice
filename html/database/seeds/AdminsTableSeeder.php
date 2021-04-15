<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
                        'name'      => 'Admin',
                        'last_name' => 'Ontwice',
                        'email'     => 'admin@grupoontwice.com',
                        'password'  => bcrypt('Ontwice2020'),
                        'role_id'   => 2,
                    ]);
                
        Admin::create([
                        'name'      => 'Admin',
                        'last_name' => 'BI',
                        'email'     => 'admin_bi@grupoontwice.com',
                        'password'  => bcrypt('Ontwice_BI#2020'),
                        'role_id'   => 3,
                    ]);

        Admin::create([
                        'name'      => 'David',
                        'last_name' => 'Gutíerrez Tovar',
                        'email'     => 'david.tovar@grupoontwice.com',
                        'password'  => bcrypt('Ontwice2020'),
                        'role_id'   => 1,
                    ]);

        Admin::create([
                        'name'      => 'Héctor Emmanuel',
                        'last_name' => 'Ortíz',
                        'email'     => 'hector.ortiz@grupoontwice.com',
                        'password'  => bcrypt('Ontwice2020'),
                        'role_id'   => 1,
                    ]);

        Admin::create([
        				'name'  		=> 'Eric',
        				'last_name' 	=> 'Montes de Oca Juárez',
        				'email' 		=> 'eric.montes@grupoontwice.com',
        				'password' 		=> bcrypt('Ontwice2020#Admin'),
        				'role_id' 		=> 1
                        ]);
                        
         Admin::create([
                        'name'  		=> 'Andres',
                        'last_name' 	=> 'Fernández Rodríguez',
                        'email' 		=> 'andres.fernandez@grupoontwice.com',
                        'password' 		=> bcrypt('Ontwice2020#Admin2'),
                        'role_id' 		=> 1
                        ]);
    
        Admin::create([
                        'name'          => 'Mario',
                        'last_name'     => 'Sanchéz',
                        'email'         => 'mario.sanchez@ontwice.com',
                        'password'      => bcrypt('Ontwice2020'),
                        'role_id'       => 1
                        ]);

        Admin::create([
                        'name'          => 'nombre',
                        'last_name'     => 'apellido',
                        'email'         => 'administrador@saladitas.com',
                        'password'      => bcrypt('Admin2020role#4'),
                        'role_id'       => 4
                        ]);                   
    }
}
