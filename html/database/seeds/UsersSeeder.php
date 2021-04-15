<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'          => "Prueba",
            'middle_name'   => "Prueba",
            'last_name'     => "Prueba",
            'email'         => "l2a_user@prueba.com",
            'telephone'     => "5555555555",
            'register_type' => "formulario",
            'active'        => 1,
            'password'      => bcrypt("fKF30C3RZ6")
        ]);
    }
}
