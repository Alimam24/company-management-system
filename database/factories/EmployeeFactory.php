<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\department;
use App\Models\emp_role;
use App\Models\emp_state;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Each employee is linked to a unique person
            'person_id' => Person::factory(),

            // Assign a random existing department
            'department_id' => department::inRandomOrder()->first()->id ?? department::factory(),

            // Assign a random existing employee state
            'emp_state_id' => emp_state::inRandomOrder()->first()->id ?? emp_state::factory(),

            'emp_role_id' => emp_role::inRandomOrder()->first()->id ?? emp_role::factory(),
        ];
    }
}
