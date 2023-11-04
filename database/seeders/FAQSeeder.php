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
                'Answers' => ' Solar panel installation is the process of setting up 
                                solar panels on your property to harness energy from the sun. Solar panels 
                                 convert sunlight into electricity, which can be used to power your home or business.',
                'Category' => 'general'
            ],
            [
                'Questions' => 'How much does a solar panel installation cost?',
                'Answers' => 'The cost of solar panel installation varies 
                                based on the size of your system, location,
                                and other factors. We offer free consultations 
                                to provide you with a personalized quote.',
                'Category' => 'general'
            ],
            [
                'Questions' => 'What are the benefits of using solar panels?',
                'Answers' => 'Solar panels offer several benefits, including reduced 
                                electricity bills, lower environmental impact, 
                                and potential savings through government incentives 
                                and tax credits.',
                'Category' => 'general'
            ],
        ]);
    }
}