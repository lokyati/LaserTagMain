<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package')->insert([
              [
                'id' => 1,
				        'package_name' => 'Kadét',
                'price' => '60',
                'match_length' => '10',
                'match_number' => '6',
                'total_time' => '1',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 2,
				        'package_name' => 'Kezdő',
                'price' => '60',
                'match_length' => '20',
                'match_number' => '3',
                'total_time' => '1',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 3,
				        'package_name' => 'Haladó',
                'price' => '35',
                'match_length' => '30',
                'match_number' => '4',
                'total_time' => '2',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 4,
				        'package_name' => 'Harcedzett',
                'price' => '40',
                'match_length' => '60',
                'match_number' => '2',
                'total_time' => '2',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 5,
                'package_name' => 'Veterán',
                'price' => '60',
                'match_length' => '60',
                'match_number' => '4',
                'total_time' => '4',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
         ]);
    }
}
