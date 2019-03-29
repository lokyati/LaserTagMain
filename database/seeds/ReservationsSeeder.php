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
                'hour' => '8'
              ],
              [
                'id' => 2,
                'year' => '2019',
                'month' => '3',
                'day' => '28',
                'hour' => '9'
              ],
              [
                'id' => 3,
                'year' => '2019',
                'month' => '3',
                'day' => '29',
                'hour' => '10'
              ],
              [
                'id' => 4,
                'year' => '2019',
                'month' => '3',
                'day' => '30',
                'hour' => '11'
              ],
              [
                'id' => 5,
                'year' => '2019',
                'month' => '3',
                'day' => '30',
                'hour' => '12'
              ],
              [
                'id' => 6,
                'year' => '2019',
                'month' => '4',
                'day' => '3',
                'hour' => '13'
              ],
              [
                'id' => 7,
                'year' => '2019',
                'month' => '4',
                'day' => '3',
                'hour' => '14'
              ],
              [
                'id' => 8,
                'year' => '2019',
                'month' => '4',
                'day' => '3',
                'hour' => '15'
              ],
              [
                'id' => 9,
                'year' => '2019',
                'month' => '4',
                'day' => '4',
                'hour' => '16'
              ],
              [
                'id' => 10,
                'year' => '2019',
                'month' => '4',
                'day' => '4',
                'hour' => '17'
              ],
              [
                'id' => 11,
                'year' => '2019',
                'month' => '4',
                'day' => '4',
                'hour' => '18'
              ],
              [
                'id' => 12,
                'year' => '2019',
                'month' => '4',
                'day' => '4',
                'hour' => '19'
              ],
              [
                'id' => 13,
                'year' => '2019',
                'month' => '4',
                'day' => '5',
                'hour' => '20'
              ],
              [
                'id' => 14,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '8'
              ],
              [
                'id' => 15,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '9'
              ],
              [
                'id' => 16,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '10'
              ],
              [
                'id' => 17,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '11'
              ],
              [
                'id' => 18,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '12'
              ],
              [
                'id' => 19,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '13'
              ],
              [
                'id' => 20,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '14'
              ],
              [
                'id' => 21,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '15'
              ],
              [
                'id' => 22,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '16'
              ],
              [
                'id' => 23,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '17'
              ],
              [
                'id' => 24,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '18'
              ],
              [
                'id' => 25,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '19'
              ],
              [
                'id' => 26,
                'year' => '2019',
                'month' => '4',
                'day' => '6',
                'hour' => '20'
              ],
         ]);
    }
}
