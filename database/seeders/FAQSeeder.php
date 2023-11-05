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
            [
                'Questions' => 'Is there anything that we do know?',
                'Answers' => 'You probably should click another tab',
                'Category' => 'solarpanel'
            ],
            [
                'Questions' => 'What is solar panel installation, and how does it work?',
                'Answers' => 'Its quick and easy. dont worry about it ',
                'Category' => 'general'
            ],
            [
                'Questions' => 'How much does a solar panel installation cost?',
                'Answers' => 'It costs a lot but will work out....trust me',
                'Category' => 'general'
            ],
            [
                'Questions' => 'What are the benefits of using solar panels?',
                'Answers' => 'for the government to pay you instead',
                'Category' => 'general'
            ],
        ]);
    }
}