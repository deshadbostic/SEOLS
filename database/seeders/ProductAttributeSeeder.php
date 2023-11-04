<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_attributes')->insert([
            [
                'product_id' => '1',
                'Attribute_type' => 'weight',
                'Attribute_value' => '60000',
            ], [
                'product_id' => '2',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
        ]);
    }
}
