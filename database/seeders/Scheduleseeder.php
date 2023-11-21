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
            'id' => '1',
            'user_id' => '4',
            'fName' => 'Jason',
            'lName' => 'Vincent',
            'address' => 'Parkinson Street',
            'DOA' => date("Y-m-d"),
            'time' => date("H:i"),
            'directions' => NULL
            ],
            [
            'id' => '2',
            'user_id' => '5',
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
