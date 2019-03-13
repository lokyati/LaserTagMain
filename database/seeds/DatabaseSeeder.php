<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AdminSeeder::class);
        //$this->call(ReservationsSeeder::class);
        $this->call(GuestTokenSeeder::class);
        $this->call(GuestSeeder::class);
    }
}
