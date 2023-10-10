<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Scheduleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule')->insert([
            [
            'name' => 'Solar Panel',
            'address' => 'Parkonson Street',
            'DOA' => date("Y-m-d h:i:s")
            ],
            [
            'name' => 'Mark Anthony',
            'address' => 'Maloney Drive Jamestown',
            'DOA' => date("Y-m-d h:i:s")
            ]
            ]);
    }
}
