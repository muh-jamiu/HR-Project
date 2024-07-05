<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'company_id' => $this->faker->numberBetween(1, 100),
            'experience' => $this->faker->numberBetween(1, 20) . ' years',
            'salary' => $this->faker->numberBetween(30000, 150000),
            'job_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Hybrid']),
            'location' => $this->faker->address,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'is_available' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->country,
            'avatar' => $this->faker->imageUrl(100, 100, 'business'),
        ];
    }
}
