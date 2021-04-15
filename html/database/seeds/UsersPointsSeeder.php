<?php

use App\Models\Participation;
use App\Models\UserPoint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 200; $i++) { 
            UserPoint::create([
                'temporality_id'    => rand(1, 3), 
                'user_id'           => $i, 
                'validated_points'  => rand(0, 90000), 
                'pending_points'    => rand(0, 40000), 
                'winner'            => false
            ]);

            for ($c=1; $c <= 3; $c++) { 
                Participation::create([
                    'temporality_id'    => $c, 
                    'user_id'           => $i, 
                    'ticket'            => Str::random(40),
                    'validation'        => rand(1,3),
                    'total_points'      => rand(0,600),
                    'ticket_code'       => Str::random(10)
                ]);
            }

        }

    }
}
