<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'MP-' . $this->faker->unique()->numberBetween(100, 999),
            'name' => $this->faker->randomElement(['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Pendidikan Agama Islam', 'Pendidikan Kewarganegaraan', 'Sejarah', 'Geografi', 'Seni Budaya', 'Pendidikan Jasmani', 'Fisika', 'Kimia', 'Biologi', 'Ekonomi', 'Sosiologi', 'Muatan Lokal']) . ' ' . $this->faker->numberBetween(1, 10),
            'type' => $this->faker->randomElement(['Muatan Nasional', 'Muatan Kewilayahan', 'Peminatan', 'Muatan Lokal']),
        ];
    }
}
