<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Teacher>
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
            'nip' => fake()->numerify('19########## 2 0##'),
            'position' => fake()->randomElement(['Guru', 'Staff TU', 'Wakasek', 'Kepala Lab']),
            'subject' => fake()->randomElement(['Matematika', 'Bahasa Inggris', 'Produktif RPL', 'Produktif TKJ', 'Fisika', 'Agama']),
            'photo' => 'https://i.pravatar.cc/300?u=' . fake()->uuid(),
        ];
    }
}
