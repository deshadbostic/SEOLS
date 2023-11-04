<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add a default piDSS administrator
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@test.com',
                'phone' => '123323223',
                'address' => 'sds',
                'visited' => '0',
                'budget' => '100',
                'password' => Hash::make('12345678'),
                'role' => 'piDSSAdministrator'
            ],
            [
                'username' => 'operationsManager',
                'first_name' => 'operationsManager',
                'last_name' => 'Manager',
                'email' => 'manager@test.com',
                'phone' => '123323223',
                'address' => 'sds',
                'visited' => '0',
                'budget' => '100',
                'password' => Hash::make('12345678'),
                'role' => 'operationsManager'
            ]
        ]);
    }
}
