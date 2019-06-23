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
                'price' => '20',
                'match_length' => '20',
                'match_number' => '2',
                'total_time' => '1',
                'popularity' => '1',
                'description' => 'Kezdő számára tervezett csomag. 2 drb. 20 perces mérkőzés vár rád. Előtte és utána pedig korlátlan ital és popcorn fogyasztás.'
              ],
              [
                'id' => 2,
				        'package_name' => 'Harcedzett',
                'price' => '50',
                'match_length' => '30',
                'match_number' => '3',
                'total_time' => '2',
                'popularity' => '1',
                'description' => 'Ha volt már lézer fegyver a kezedben, ez a te csomagod. 3 drb. 30 perces mérkőzés vár rád. Előtte és utána pedig korlátlan ital és popcorn fogyasztás.'
              ],
              [
                'id' => 3,
				        'package_name' => 'Veterán',
                'price' => '65',
                'match_length' => '35',
                'match_number' => '4',
                'total_time' => '3',
                'popularity' => '1',
                'description' => 'Ezt a csomagot választva, megmutathatod tehetséged. 4 drb. 35 perces mérkőzés vár rád. Előtte és utána pedig korlátlan ital és popcorn fogyasztás.'
              ],
         ]);
    }
}
