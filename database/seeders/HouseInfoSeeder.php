<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class HouseInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('house_info')->insert([
            [
                'customer_fName'=> 'John',
                'customer_lName'=> 'Doe',
                'electricity_usage'=>201,
                'roof_size'=>1850,
                'roof_slope'=>0,
                'roof_age'=>2
            ],
            [
                'customer_fName'=> 'Jill',
                'customer_lName'=> 'Jackman',
                'electricity_usage'=>185,
                'roof_size'=>1925,
                'roof_slope'=>22,
                'roof_age'=>8
            ],
            [
                'customer_fName'=> 'Mariy',
                'customer_lName'=> 'Rose',
                'electricity_usage'=>192,
                'roof_size'=>1775,
                'roof_slope'=>42,
                'roof_age'=>20
            ]
            ]);
    }
}
