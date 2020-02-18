<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('houses')->insert(['name' => 'test', 'price' => 120000]);

        $file = new SplFileObject("/home/serg/Projects/test/property-data.csv");
        $file->setFlags(SplFileObject::READ_CSV);
        foreach ($file as $row){
            list($name, $price, $bedrooms, $bathrooms, $storeys, $garages) = $row;
            DB::table("houses")->insert([
                'name' => $name,
                'price' => $price,
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
                'storeys' => $storeys,
                'garages' => $garages
            ]);
        }
    }
}
