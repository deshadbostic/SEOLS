<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add a default piDSS administrator
        User::factory()->admin()->create();
        // Add a default piDSS manager
        User::factory()->manager()->create();
    }
}
