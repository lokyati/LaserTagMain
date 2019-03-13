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
				'user_id' => 2,
				'package_id' => 3,
				'players' => 6,
				'dateTime' => '2017/06/24',
				'tel' => 345345,
				'email' => 'sdfsdg@gdfgdf.com',
				'note' => 'ssdggs',
				'bonus_used' => 3,
				'price' => 345,
				'paid_status' => true
              ],
              
         ]);
    }
}
