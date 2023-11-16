<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50), // Change the range as per your product IDs
            'Attribute_type' => $this->faker->randomElement(['weight', 'capacity', 'voltage', 'size', 'wattage', 'efficiency', 'type', 'length']), // Add more types as needed
            'Attribute_value' => $this->faker->numberBetween(20, 1000), // Replace with appropriate attribute values
            // Define other attributes as needed
        ];
    }
}
