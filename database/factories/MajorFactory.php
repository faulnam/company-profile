<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Major>
 */
class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indoMajors = [
            'Rekayasa Perangkat Lunak',
            'Teknik Komputer dan Jaringan',
            'Multimedia',
            'Akuntansi',
            'Administrasi Perkantoran',
            'Pemasaran',
            'Teknik Kendaraan Ringan',
            'Teknik Bisnis Sepeda Motor',
            'Teknik Elektronika Industri'
        ];

        $name = fake()->unique()->randomElement($indoMajors);
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'acronym' => strtoupper(substr(str_replace(' ', '', $name), 0, 3)),
            'description' => 'Jurusan ' . $name . ' membekali siswa dengan keterampilan praktis dan teoritis yang dibutuhkan oleh industri saat ini. Lulusan dipersiapkan untuk langsung bekerja atau melanjutkan pendidikan ke jenjang yang lebih tinggi.',
            'head_of_major' => fake()->name(),
            'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
        ];
    }
}
