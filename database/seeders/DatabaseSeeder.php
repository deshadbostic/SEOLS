<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            ProductAttributeSeeder::class
        ]);

        $this->call([
            CustomerSeeder::class,
        ]);

        $this->call([
            Scheduleseeder::class,
        ]);

        $this->call([
            HouseInfoSeeder::class,
        ]);

        $this->call([
            FAQSeeder::class,
        ]);
        $this->call([
            AdminSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'username' => 'Test User',
             'first_name' => 'Test',
             'last_name' => 'User',
             'email' => 'test@example.com',
             'phone' => '123456789',
             'address' => 'Corner of Washington and 6th',
             'visited' => '0',
             'budget' => '50000',
             'password' => Hash::make('12345678'),
             'role' => 'Customer',
         ]);
    }
}
