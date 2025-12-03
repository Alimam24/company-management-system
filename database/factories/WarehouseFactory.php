<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\city;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'WarehouseName' => $this->faker->company,
            'city_id' => City::inRandomOrder()->first()->id,
            'Address' => $this->faker->address,
            'Phone' => $this->faker->phoneNumber,
            'Brochure_url' => $this->faker->optional()->imageUrl(640, 480, 'business'),
        ];
    }
}
