<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current index for generating sequential logins and passwords.
     */
    protected static int $index = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loginNumber = str_pad(static::$index++, 2, '0', STR_PAD_LEFT); // Generates 01, 02, etc.
        $password = 'pas_' . $loginNumber;

        return [
            'login' => 'login_' . $loginNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make($password), // Hash the generated password
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->unique()->firstName(),
            'last_name' => $this->faker->unique()->lastName(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'image_link' => $this->faker->imageUrl(),
            'is_removed' => false
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
