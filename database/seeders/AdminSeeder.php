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
                'first_name' => 'Admin',
                'last_name' => 'Test',
                'email' => 'admin@example.com',
                'phone' => '123323223',
                'address' => 'Lot #465',
                'visited' => '0',
                'budget' => '100',
                'password' => Hash::make('12345678'),
                'role' => 'piDSSAdministrator'
            ],
            [
                'username' => 'operationsManager',
                'first_name' => 'Manager',
                'last_name' => 'Test',
                'email' => 'manager@example.com',
                'phone' => '123456789',
                'address' => 'Street #1',
                'visited' => '0',
                'budget' => '25000',
                'password' => Hash::make('12345678'),
                'role' => 'operationsManager'
            ]
        ]);
    }
}
