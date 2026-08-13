<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        // Random start time between 07:00 and 13:00
        $startHour = $this->faker->numberBetween(7, 13);
        $startMinute = $this->faker->randomElement(['00', '15', '30', '45']);
        $startTime = sprintf('%02d:%s:00', $startHour, $startMinute);
        
        // End time is usually 1-3 hours later
        $endHour = $startHour + $this->faker->numberBetween(1, 3);
        $endTime = sprintf('%02d:%s:00', $endHour, $startMinute);

        return [
            'classroom_id' => Classroom::inRandomOrder()->first()?->id ?? Classroom::factory(),
            'subject_id' => Subject::inRandomOrder()->first()?->id ?? Subject::factory(),
            'teacher_id' => Teacher::inRandomOrder()->first()?->id ?? Teacher::factory(),
            'day' => $this->faker->randomElement($days),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
