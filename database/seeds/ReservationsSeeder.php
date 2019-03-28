<?php

use Illuminate\Database\Seeder;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
              [
                'id' => 1,
				'year' => '2019',
                'month' => '3',
                'day' => '28',
                'hour' => '13'
              ],
              [
                'id' => 2,
                'year' => '2019',
                'month' => '3',
                'day' => '30',
                'hour' => '10'
              ],
         ]);
    }
}
