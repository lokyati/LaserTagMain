<?php

use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
              [
                'id' => 1,
				'rank_name' => 'Közlegény',
                'required_lvl' => 1
              ],
              [
                'id' => 2,
				'rank_name' => 'Tizedes',
                'required_lvl' => 3
              ],
              [
                'id' => 3,
				'rank_name' => 'Őrmester',
                'required_lvl' => 6
              ],
              [
                'id' => 4,
				'rank_name' => 'Parancsnok',
                'required_lvl' => 9
              ],
              [
                'id' => 5,
				'rank_name' => 'Tiszt',
                'required_lvl' => 12
              ],
              [
                'id' => 6,
				'rank_name' => 'Rangidős tiszt',
                'required_lvl' => 15
              ],
              [
                'id' => 7,
				'rank_name' => 'Hadnagy',
                'required_lvl' => 18
              ],
              [
                'id' => 8,
				'rank_name' => 'Főhadnagy',
                'required_lvl' => 21
              ],
              [
                'id' => 9,
				'rank_name' => 'Százados',
                'required_lvl' => 24
              ],
              [
                'id' => 10,
				'rank_name' => 'Ezredes',
                'required_lvl' => 27
              ],
              [
                'id' => 11,
				'rank_name' => 'Tábornok',
                'required_lvl' => 30
              ],
              [
                'id' => 12,
				'rank_name' => 'Hadseregtábornok',
                'required_lvl' => 33
              ],
         ]);
    }
}
