<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('12345678'), // Use bcrypt() to hash the password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'Customer',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => '+1 (123) 456-7890',
            'address' => $this->faker->address,
            'budget' => $this->faker->numberBetween(20000, 100000),
            'visited' => false,
            // Define other attributes as needed
        ];
    }

    /**
     * Define an 'admin' state with different attributes.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'piDSSAdministrator',
                // Add any other admin-specific attributes here
            ];
        });
    }

    /**
     * Define an 'operationsManager' state with different attributes.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function manager(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'operationsManager',
                // Add any other manager-specific attributes here
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
