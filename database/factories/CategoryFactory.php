<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indoCategories = [
            'Akademik',
            'Prestasi',
            'Pengumuman',
            'Ekstrakurikuler',
            'Event',
            'Teknologi',
            'Alumni',
            'Inovasi'
        ];

        $name = fake()->unique()->randomElement($indoCategories);
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'color' => fake()->randomElement(['#0d9488', '#2563eb', '#dc2626', '#16a34a', '#ca8a04']),
        ];
    }
}
