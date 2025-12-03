<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\customer_type;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Each customer is linked to a unique person
            'person_id' => Person::factory(),

            // Assign a random existing customer type
            'customer_type_id' => customer_type::inRandomOrder()->first()->id ?? customer_type::factory(),
        ];
    }
}
