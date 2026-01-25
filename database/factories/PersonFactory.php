<?php

namespace Database\Factories;

use App\Models\Person; 
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'FirstName' => $this->faker->firstName(),
            'LastName' => $this->faker->lastName(),
            'NationalId' => $this->faker->unique()->numerify('###########'), // 11-digit ID
            'email' => $this->faker->unique()->safeEmail(),
            'phone_num' => $this->faker->optional()->phoneNumber(),
            'BirthDate' => $this->faker->date(),
            'avatar_url' => 'avatars/profile.png',
        ];
    }
}
