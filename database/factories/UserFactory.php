<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(), // sesuai dengan field 'nama' di tabel
            'email' => $this->faker->unique()->safeEmail(),
            'id_role' => rand(1, 15),       // sesuaikan dengan jumlah data role yang kamu seed
            'id_bidang' => rand(1, 6),      // sesuaikan dengan jumlah data bidang yang kamu seed
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password123'), // password default
            'remember_token' => Str::random(10),
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
