<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->unique()->word,
            'Price' => $this->faker->randomFloat(2, 100, 10000),
            'Quantity' => $this->faker->numberBetween(1, 100),
            'Category' => $this->faker->randomElement(['Battery', 'Solar Panel', 'Inverter', 'Wire', 'Cable', 'Adapter']),
            // Define other attributes as needed
        ];
    }
}
