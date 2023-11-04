<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'Name' => 'Tesla Powerwall ',
                'Price' => '6000',
                'Quantity' => '13.5',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Tesla Powerwalls ',
                'Price' => '6000',
                'Quantity' => '13.5',
                'Category' => 'battery'
            ],
        ]);
    }
}
