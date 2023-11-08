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
                'Name' => 'Tesla Powerwall',
                'Price' => '6000',
                'Quantity' => '14',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Tesla Powerwalls',
                'Price' => '5800',
                'Quantity' => '14',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Tesla Powerwall MK2',
                'Price' => '6000',
                'Quantity' => '13',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Tesla Powerwall MK1 ',
                'Price' => '6700',
                'Quantity' => '10',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Monocrystalline MK2',
                'Price' => '7500',
                'Quantity' => '12',
                'Category' => 'solar_panel'
            ],
            [
                'Name' => 'Polycrystalline MK1',
                'Price' => '8000',
                'Quantity' => '19',
                'Category' => 'solar_panel'
            ],
            [
                'Name' => 'power optimiser',
                'Price' => '2000',
                'Quantity' => '3',
                'Category' => 'inverter'
            ],
            [
                'Name' => 'Tesla Powerwall MK1 ',
                'Price' => '6700',
                'Quantity' => '10',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Monocrystalline MK2',
                'Price' => '7500',
                'Quantity' => '12',
                'Category' => 'solar_panel'
            ],
            [
                'Name' => 'Polycrystalline MK1',
                'Price' => '8000',
                'Quantity' => '19',
                'Category' => 'solar_panel'
            ],
            [
                'Name' => 'power optimiser',
                'Price' => '2000',
                'Quantity' => '3',
                'Category' => 'inverter'
            ],
            [
                'Name' => 'Tesla Powerwall',
                'Price' => '6000',
                'Quantity' => '14',
                'Category' => 'battery'
            ],
            [
                'Name' => 'Tesla Powerwalls',
                'Price' => '5800',
                'Quantity' => '14',
                'Category' => 'battery'
            ],
        ]);
    }
}
