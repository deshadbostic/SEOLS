<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
            'name' => 'Solar Panel',
            'description' => '300 Watt panel',
            'price' => '1000.00'
            ],
            [
            'name' => 'Solar Panel Inverter',
            'description' => '1800 VA',
            'price' => '3000.00'
            ]
        ]);
            
    }
}
