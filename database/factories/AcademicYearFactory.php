<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2020, 2026);
        return [
            'name' => $year . '/' . ($year + 1),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'is_active' => false,
        ];
    }
}
