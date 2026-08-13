<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => collect(['Pengumuman Libur', 'Rapat Wali Murid', 'Jadwal Ujian', 'Pembayaran SPP', 'Kegiatan Ekstrakurikuler'])->random() . ' ' . $this->faker->year(),
            'content' => $this->faker->paragraphs(3, true),
            'is_active' => $this->faker->boolean(80), // 80% active
        ];
    }
}
