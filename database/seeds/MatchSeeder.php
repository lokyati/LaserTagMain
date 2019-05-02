<?php

use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
              [
                'id' => 1,
                'user_id' => 1,
                'score' => 50,
                'all_shot' => 200,
                'all_hit' => 110,
                'all_acc' => 2,
                'bonus' => 3,
				'match_date' => '2000-01-01',
              ],
         ]);

        
    }
}
