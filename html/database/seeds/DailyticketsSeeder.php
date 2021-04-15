<?php

use App\Models\DailyTicket;
use Illuminate\Database\Seeder;

class DailyticketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailyTicket::create([
            'total_tickets_by_day' => 10
        ]);
    }
}
