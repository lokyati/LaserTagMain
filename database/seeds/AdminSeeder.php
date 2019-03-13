<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
              [
                'id' => 1,
                'email' => 'admin@admin.com',
                'password' => '123456'
              ],
              
         ]);
    }
}
