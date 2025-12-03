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
            'name' => $this->faker->words(2, true), // e.g. "Wireless Mouse"
            'description' => $this->faker->optional()->sentence(10),
            'price' => $this->faker->randomFloat(2, 10, 2000), // between 10 and 2000
        ];
    }
}
