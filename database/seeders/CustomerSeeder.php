<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'phone' => '1234567',
                'address' => 'Sandy Lane, St. James',
                'email' => 'john_doe_email@gmail.com',
                'budget' => '5000.00',
                'visited' => true
                
            ],
            [
                'fname' => 'Jill',
                'lname' => 'Jackman',
                'phone' => '7654321',
                'address' => 'Lowlands, Christ Church',
                'email' => 'jill_jackman_email@gmail.com',
                'budget' => '7000.00',
                'visited' => false
            ],
            [
                'fname' => 'Mariya',
                'lname' => 'Rose',
                'phone' => '1452173',
                'address' => 'Warrens, St Michael',
                'email' => 'mariya_rose_email@outlook.com',
                'budget' => '3400.00',
                'visited' => false
            ]
        ]);
    }
}
