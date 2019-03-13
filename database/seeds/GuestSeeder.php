<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GuestUser::class, 10)->create();


        /*DB::table('guest_users')->insert([
              [
                'id' => 1,
                'warname' => 'warrior1',
                'guest_token_id' => 1,
                'score' => 200,
                'all_shot' => 2000,
                'all_hit' => 2500,
                'all_acc' => 300,
                'bonus' => 4,
                'date' => Carbon::create('2019','03','13')
              ],
              
         ]);*/
    }
}
