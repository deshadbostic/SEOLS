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
                'Answers' => 'This stores power for the system',
                'Category' => 'battery'
            ],
            [
                'Questions' => 'What is an inverter you might ask',
                'Answers' => 'That is in charge of power conversions',
                'Category' => 'inverter'
            ],
            [
                'Questions' => 'How much for a solar panel?',
                'Answers' => 'It depends on what You will need',
                'Category' => 'solarpanel'
            ],
            [
                'Questions' => 'What is solar panel installation, and how does it work?',
                'Answers' => 'Its quick and easy. dont worry about it ',
                'Category' => 'general'
            ],
            [
                'Questions' => 'How much does a solar panel installation cost?',
                'Answers' => 'They have various ranges depending on your demands',
                'Category' => 'general'
            ],
            [
                'Questions' => 'What are the benefits of using solar panels?',
                'Answers' => 'It provides sustainable energy. Greener too!!',
                'Category' => 'general'
            ],
        ]);
    }
}