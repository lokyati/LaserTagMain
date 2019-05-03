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
                'price' => '10',
                'time' => '1',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 2,
				        'package_name' => 'Kezdő',
                'price' => '20',
                'time' => '2',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 3,
				        'package_name' => 'Harcedzett',
                'price' => '30',
                'time' => '3',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
              [
                'id' => 4,
				        'package_name' => 'Veterán',
                'price' => '40',
                'time' => '4',
                'popularity' => '1',
                'description' => 'Et officia mollit quis dolore proident velit consectetur eiusmod ea sit enim cupidatat ut sed.'
              ],
         ]);
    }
}