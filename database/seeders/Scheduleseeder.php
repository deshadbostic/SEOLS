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
            'id' => '23',
            'fName' => 'Jason',
            'lName' => 'Vincent',
            'address' => 'Parkinson Street',
            'DOA' => date("Y-m-d"),
            'time' => date("H:i"),
            'directions' => NULL
            ],
            [
            'id' => '46',
            'fName' => 'Mark',
            'lName' => 'Anthony',
            'address' => 'Maloney Drive, Jamestown',
            'DOA' => date("Y-m-d"),
            'time' => date("H:i"),
            'directions' => '1st right turn after Northway Drive'
            ]
            ]);
    }
}
