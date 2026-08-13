<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Subject;
use App\Models\AcademicYear;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()?->id ?? Student::factory(),
            'subject_id' => Subject::inRandomOrder()->first()?->id ?? Subject::factory(),
            'academic_year_id' => AcademicYear::inRandomOrder()->first()?->id ?? AcademicYear::factory(),
            'score' => $this->faker->numberBetween(60, 100),
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
