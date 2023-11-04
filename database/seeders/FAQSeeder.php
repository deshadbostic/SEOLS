<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('FAQs')->insert([
            [
                'Questions' => 'what is a battery you might ask ',
                'Answers' => 'we dont know',
                'Category' => 'battery'
            ],
            [
                'Questions' => 'What is an inverter you might ask',
                'Answers' => 'we dont know this either',
                'Category' => 'inverter'
            ],
        ]);
    }
}