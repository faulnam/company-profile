<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('####'),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->dateTimeBetween('-18 years', '-15 years')->format('Y-m-d'),
            'address' => $this->faker->address(),
            'parent_phone' => $this->faker->phoneNumber(),
            'classroom_id' => \App\Models\Classroom::inRandomOrder()->first()?->id ?? \App\Models\Classroom::factory(),
            'parent_id' => \App\Models\User::role('walimurid')->inRandomOrder()->first()?->id,
        ];
    }
}
