<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'gender'=> fake()->numberBetween(1,2),
            'password' => '$2y$12$Ld5lzHKB4Wf/YjSjJbC3pe/hBa5O5Z0anHuS3W2LG7R.Jv7JJRKHG'
        ];
    }
}
