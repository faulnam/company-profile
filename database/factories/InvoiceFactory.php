<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $types = [
            'SPP Bulan ' . $this->faker->monthName() . ' ' . $this->faker->year(),
            'Uang Gedung Tahun Ajaran ' . $this->faker->year(),
            'Biaya Ujian Semester',
            'Iuran Rekreasi / Study Tour',
            'Sumbangan Buku Perpustakaan'
        ];

        return [
            'student_id' => Student::inRandomOrder()->first()?->id ?? Student::factory(),
            'title' => $this->faker->randomElement($types),
            'amount' => $this->faker->randomElement([150000, 250000, 300000, 500000, 1500000]),
            'is_paid' => $this->faker->boolean(40), // 40% chance of being paid
            'due_date' => $this->faker->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
        ];
    }
}
