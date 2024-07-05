<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), 
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'unique_id' => Str::uuid(),
            'avatar' => $this->faker->imageUrl(),
            'bio' => $this->faker->paragraph,
            'country' => $this->faker->country,
            'company_name' => $this->faker->company,
            'company_type' => $this->faker->companySuffix,
            'company_branch' => $this->faker->word,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'salary' => $this->faker->numberBetween(30000, 150000),
            'phone' => $this->faker->phoneNumber,
            'title' => $this->faker->jobTitle,
            'education' => $this->faker->word,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'is_verified' => $this->faker->boolean,
            'role' => $this->faker->randomElement(['candidate', 'company']), // Default role
            'cv' => $this->faker->url,
            'skills' => implode(', ', $this->faker->words(5)),
            'experience' => $this->faker->numberBetween(1, 20) . ' years',
        ];
    }
}
