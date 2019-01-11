<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tickets")->insert(array(
            [
                'event' => "Comedy show",
                'price' => 100.00,
                'ticket_type_id' => 1,
                'total_number_available' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event' => "Comedy show",
                'price' => 300.00,
                'ticket_type_id' => 2,
                'total_number_available' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event' => "Comedy show",
                'price' => 500.00,
                'ticket_type_id' => 3,
                'total_number_available' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ));
    }
}
