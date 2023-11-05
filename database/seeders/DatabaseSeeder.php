<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
