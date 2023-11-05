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
            ], 
            [
                'product_id' => '2',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '3',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '4',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '5',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '6',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '7',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '8',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '9',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '10',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '11',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
        ]);
    }
}
