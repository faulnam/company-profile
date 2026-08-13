<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()?->id ?? Student::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Izin', 'Sakit', 'Alpa']),
            'notes' => $this->faker->optional(0.2)->sentence(), // 20% chance of notes
        ];
    }
}
