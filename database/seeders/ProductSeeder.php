<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inverter')->insert([
            [
                'Model' => 'SolarEdgeSE5000',
                'InputPowerWatts' => '5000',
                'OutputPowerWatts' => '4800',
                'SizeInches' => '30x16x8',
                'FrequencyHz' => '50-60',
                'Efficiency' => '97.5',
                'Cost' => '800'
            ],
            [
                'Model' => 'SMASunnyBoy',
                'InputPowerWatts' => '6000',
                'OutputPowerWatts' => '5700',
                'SizeInches' => '28x19x10',
                'FrequencyHz' => '50-60',
                'Efficiency' => '98.0',
                'Cost' => '900'
            ],
            [
                'Model' => 'FroniusPrimo',
                'InputPowerWatts' => '7000',
                'OutputPowerWatts' => '6600',
                'SizeInches' => '32x20x12',
                'FrequencyHz' => '50-60',
                'Efficiency' => '98.5',
                'Cost' => '1000'
            ]

        ]);

        DB::table('solar_panel')->insert([
            [
                'Model' => 'Lg NeON',
                'Warranty' => '25',
                'Durability' => 'High',
                'Cost' => '400',
                'EnergyOutputWatts' => '350',
                'DimensionsInches' => '66.38x40x1.57'
            ],
            [
                'Model' => 'Panasonic Hit',
                'Warranty' => '25',
                'Durability' => 'Very High',
                'Cost' => '450',
                'EnergyOutputWatts' => '380',
                'DimensionsInches' => '62.6x41.2x1.4'
            ],
            [
                'Model' => 'SunPower Maxeon 3',
                'Warranty' => '25',
                'Durability' => 'Extreme',
                'Cost' => '500',
                'EnergyOutputWatts' => '400',
                'DimensionsInches' => '61.4x41.2x1.6'
            ]

        ]);

        DB::table('battery')->insert([
            [
                'Model' => 'Tesla Powerwall 2',
                'CapacityAh' => '13.5',
                'VoltageV' => '48',
                'RatingWh' => '6480',
                'WeightLbs' => '251.3',
                'Cost' => '6000'
            ],
            [
                'Model' => 'LG Chem RESU',
                'CapacityAh' => '9.8',
                'VoltageV' => '48',
                'RatingWh' => '4704',
                'WeightLbs' => '220.4',
                'Cost' => '5000'
            ],
            [
                'Model' => 'Sonnen Eco Compact',
                'CapacityAh' => '11',
                'VoltageV' => '48',
                'RatingWh' => '5280',
                'WeightLbs' => '198.4',
                'Cost' => '5500'
            ]

        ]);
    }
}
