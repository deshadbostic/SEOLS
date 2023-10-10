<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ItemSeeder extends Seeder
{
    public function run(): void
    {
            /**
     * Run the database seeds.
     *
     * @return void
     */
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
    /**
     * Run the database seeds.
     *
     * @return void
     */

}
