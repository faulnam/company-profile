<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indoTitles = [
            'Sejarah Singkat',
            'Visi dan Misi',
            'Fasilitas Unggulan',
            'Struktur Organisasi',
            'Tata Tertib Siswa'
        ];
        
        $indoParagraphs = [
            'Halaman ini berisi informasi resmi mengenai kebijakan dan struktur yang ada di lingkungan pendidikan kami. Kami selalu berupaya memberikan transparansi dan kemudahan akses bagi masyarakat luar maupun internal.',
            'Seiring berkembangnya zaman, kami terus melakukan adaptasi terhadap kurikulum serta metode pembelajaran. Tujuannya adalah untuk mencetak lulusan yang tidak hanya cerdas secara akademik, namun juga memiliki integritas dan karakter yang kuat.',
            'Berbagai fasilitas pendukung telah disiapkan untuk memastikan proses belajar mengajar berjalan dengan optimal. Mulai dari laboratorium komputer, perpustakaan digital, hingga sarana olahraga yang memadai untuk seluruh siswa.',
            'Kami percaya bahwa kolaborasi antara sekolah, orang tua, dan masyarakat adalah kunci utama kesuksesan pendidikan. Oleh karena itu, kami selalu terbuka terhadap saran dan masukan yang membangun.'
        ];

        $title = fake()->randomElement($indoTitles) . ' ' . fake()->unique()->numberBetween(1, 1000);
        $contentParagraphs = fake()->randomElements($indoParagraphs, 4);

        return [
            'title' => ucwords($title),
            'slug' => \Illuminate\Support\Str::slug($title),
            'content' => '<p>' . implode('</p><p>', $contentParagraphs) . '</p>',
        ];
    }
}
