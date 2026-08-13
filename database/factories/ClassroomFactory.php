<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grade = $this->faker->randomElement(['X', 'XI', 'XII']);
        return [
            'name' => $grade . ' ' . $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', '1', '2', '3']),
            'major_id' => \App\Models\Major::inRandomOrder()->first()?->id ?? \App\Models\Major::factory(),
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()?->id ?? \App\Models\Teacher::factory(),
        ];
    }
}
