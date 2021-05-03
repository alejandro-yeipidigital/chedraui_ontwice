<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
                        'estado' => "-"
                        ]);
        Estado::create([
                        'estado' => "Aguascalientes"
                        ]);
        Estado::create([
                        'estado' => "Baja California"
                        ]);
        Estado::create([
                        'estado' => "Baja California Sur"
                        ]);
        Estado::create([
                        'estado' => "Campeche"
                        ]);
        Estado::create([
                        'estado' => "Ciudad de México"
                        ]);
        Estado::create([
                        'estado' => "Chiapas"
                        ]);
        Estado::create([
                        'estado' => "Chihuahua"
                        ]);
        Estado::create([
                        'estado' => "Coahuila de Zaragoza"
                        ]);
        Estado::create([
                        'estado' => "Colima"
                        ]);
        Estado::create([
                        'estado' => "Durango"
                        ]);
        Estado::create([
                        'estado' => "Estado de México"
                        ]);
        Estado::create([
                        'estado' => "Guanajuato"
                        ]);
        Estado::create([
                        'estado' => "Guerrero"
                        ]);
        Estado::create([
                        'estado' => "Hidalgo"
                        ]);
        Estado::create([
                        'estado' => "Jalisco"
                        ]);
        Estado::create([
                        'estado' => "Michoacán de Ocampo"
                        ]);
        Estado::create([
                        'estado' => "Morelos"
                        ]);
        Estado::create([
                        'estado' => "Nayarit"
                        ]);
        Estado::create([
                        'estado' => "Nuevo León"
                        ]);
        Estado::create([
                        'estado' => "Oaxaca"
                        ]);
        Estado::create([
                        'estado' => "Puebla"
                        ]);
        Estado::create([
                        'estado' => "Querétaro"
                        ]);
        Estado::create([
                        'estado' => "Quintana Roo"
                        ]);
        Estado::create([
                        'estado' => "San Luis Potosí"
                        ]);
        Estado::create([
                        'estado' => "Sinaloa"
                        ]);
        Estado::create([
                        'estado' => "Sonora"
                        ]);
        Estado::create([
                        'estado' => "Tabasco"
                        ]);
        Estado::create([
                        'estado' => "Tamaulipas"
                        ]);
        Estado::create([
                        'estado' => "Tlaxcala"
                        ]);
        Estado::create([
                        'estado' => "Veracruz de Ignacio de la Llave"
                        ]);
        Estado::create([
                        'estado' => "Yucatán"
                        ]);
        Estado::create([
                        'estado' => "Zacatecas"
                        ]);
    }
}