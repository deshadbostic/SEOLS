<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Product::factory()->count(50)->create();
        DB::table('products')->insert([
            [
                'Name' => 'Tesla Powerwall',
                'Price' => '600',
                'Quantity' => '14',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Tesla Powerwalls',
                'Price' => '580',
                'Quantity' => '14',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Tesla Powerwall MK2',
                'Price' => '600',
                'Quantity' => '13',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Tesla Powerwall MK1 ',
                'Price' => '670',
                'Quantity' => '10',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Monocrystalline MK2',
                'Price' => '750',
                'Quantity' => '12',
                'Category' => 'Solar Panel'
            ],
            [
                'Name' => 'Polycrystalline MK1',
                'Price' => '730',
                'Quantity' => '19',
                'Category' => 'Solar Panel'
            ],
            [
                'Name' => 'Power Optimiser Mk2',
                'Price' => '200',
                'Quantity' => '3',
                'Category' => 'Inverter'
            ],
            [
                'Name' => 'Tesla Powerwall MK1 ',
                'Price' => '670',
                'Quantity' => '10',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Monocrystalline MK3',
                'Price' => '770',
                'Quantity' => '12',
                'Category' => 'Solar Panel'
            ],
            [
                'Name' => 'Polycrystalline MK2',
                'Price' => '800',
                'Quantity' => '19',
                'Category' => 'Solar Panel'
            ],
            [
                'Name' => 'Power Optimiser',
                'Price' => '150',
                'Quantity' => '3',
                'Category' => 'Inverter'
            ],
            [
                'Name' => 'Tesla Powerwall',
                'Price' => '600',
                'Quantity' => '14',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'Tesla Powerwalls',
                'Price' => '580',
                'Quantity' => '14',
                'Category' => 'Battery'
            ],
            [
                'Name' => 'THHN ',
                'Price' => '80',
                'Quantity' => '05',
                'Category' => 'Wire'
            ],
            [
                'Name' => 'USE 2',
                'Price' => '58',
                'Quantity' => '30',
                'Category' => 'Wire'
            ],
            [
                'Name' => 'PV',
                'Price' => '70',
                'Quantity' => '10',
                'Category' => 'Wire'
            ],
        ]);
    }
}
