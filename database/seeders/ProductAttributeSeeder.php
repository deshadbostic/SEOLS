<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ProductAttribute::factory()->count(150)->create();
        DB::table('product_attributes')->insert([
            [
                'product_id' => '10',
                'Attribute_type' => 'wattage',
                'Attribute_value' => '300W',
            ],
            [
                'product_id' => '9',
                'Attribute_type' => 'wattage',
                'Attribute_value' => '450W',
            ],
            [
                'product_id' => '1',
                'Attribute_type' => 'weight',
                'Attribute_value' => '60000lbs',
            ],
            [
                'product_id' => '1',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '3000maH',
            ],
            [
                'product_id' => '12',
                'Attribute_type' => 'voltage',
                'Attribute_value' => '24V',
            ],
            [
                'product_id' => '13',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '3300maH',
            ],
            [
                'product_id' => '2',
                'Attribute_type' => 'size',
                'Attribute_value' => '113.5',
            ],
            [
                'product_id' => '15',
                'Attribute_type' => 'voltage',
                'Attribute_value' => '12V',
            ],
            [
                'product_id' => '3',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '2700maH',
            ],
            [
                'product_id' => '3',
                'Attribute_type' => 'weight',
                'Attribute_value' => '5800lbs',
            ],
            [
                'product_id' => '14',
                'Attribute_type' => 'voltage',
                'Attribute_value' => '24V',
            ],
            [
                'product_id' => '3',
                'Attribute_type' => 'size',
                'Attribute_value' => '114.5',
            ],
            [
                'product_id' => '4',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '6000maH',
            ],
            [
                'product_id' => '4',
                'Attribute_type' => 'weight',
                'Attribute_value' => '4000lbs',
            ],
            [
                'product_id' => '16',
                'Attribute_type' => 'voltage',
                'Attribute_value' => '24V',
            ],
            [
                'product_id' => '4',
                'Attribute_type' => 'size',
                'Attribute_value' => '110',
            ],
            [
                'product_id' => '5',
                'Attribute_type' => 'wattage',
                'Attribute_value' => '350W',
            ],
            [
                'product_id' => '5',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '89%',
            ],
            [
                'product_id' => '6',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '92%',
            ],
            [
                'product_id' => '6',
                'Attribute_type' => 'wattage',
                'Attribute_value' => '400W',
            ],
            [
                'product_id' => '7',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '5000 kW',
            ],
            [
                'product_id' => '7',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '78%',
            ],
            [
                'product_id' => '7',
                'Attribute_type' => 'type',
                'Attribute_value' => 'string'
            ],
            [
                'product_id' => '8',
                'Attribute_type' => 'type',
                'Attribute_value' => 'microinverter'
            ],
            [
                'product_id' => '8',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '90%'
            ],
            [
                'product_id' => '8',
                'Attribute_type' => 'type',
                'Attribute_value' => 'string'
            ],
            [
                'product_id' => '8',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '6000 kW'
            ],
            [
                'product_id' => '9',
                'Attribute_type' => 'capacity',
                'Attribute_value' => '5300 kW'
            ],
            [
                'product_id' => '9',
                'Attribute_type' => 'type',
                'Attribute_value' => 'string'
            ],
            [
                'product_id' => '13',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '82%'
            ],
            [
                'product_id' => '14',
                'Attribute_type' => 'length',
                'Attribute_value' => '100 foot',
            ],
            [
                'product_id' => '15',
                'Attribute_type' => 'length',
                'Attribute_value' => '100 foot'
            ],
            [
                'product_id' => '16',
                'Attribute_type' => 'length',
                'Attribute_value' => '100 foot'
            ],
            [
                'product_id' => '11',
                'Attribute_type' => 'efficiency',
                'Attribute_value' => '90%'
            ],
        ]);
    }
}
