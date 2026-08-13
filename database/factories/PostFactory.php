<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indoTitles = [
            'Prestasi Gemilang Siswa di Ajang Lomba Nasional',
            'Penerimaan Peserta Didik Baru Tahun Ajaran Ini',
            'Kegiatan Ekstrakurikuler Wajib Pramuka',
            'Kunjungan Industri ke Perusahaan Teknologi',
            'Pelaksanaan Ujian Tengah Semester Berbasis Komputer',
            'Upacara Bendera Peringatan Hari Pendidikan',
            'Program Bantuan Siswa Berprestasi',
            'Seminar Nasional Kewirausahaan Pemuda',
            'Pembagian Raport dan Pertemuan Orang Tua',
            'Gotong Royong Membersihkan Lingkungan Sekolah'
        ];

        $indoParagraphs = [
            'Kegiatan ini merupakan salah satu agenda tahunan yang selalu dinantikan oleh seluruh warga sekolah. Dengan adanya program ini, diharapkan para siswa dapat mengembangkan potensi diri mereka secara maksimal dan siap menghadapi tantangan di masa depan.',
            'Selain itu, sekolah juga memberikan fasilitas pendukung yang memadai untuk memastikan kelancaran setiap kegiatan. Hal ini sejalan dengan visi dan misi sekolah untuk terus mencetak generasi penerus yang berprestasi dan berkarakter.',
            'Acara tersebut dihadiri oleh berbagai tokoh penting, termasuk perwakilan dari dinas pendidikan setempat serta komite sekolah. Mereka memberikan apresiasi yang tinggi atas dedikasi dan kerja keras panitia penyelenggara.',
            'Antusiasme peserta sangat terlihat sejak awal acara hingga penutupan. Banyak ilmu dan pengalaman baru yang bisa diambil, yang pastinya sangat bermanfaat untuk bekal mereka saat terjun ke dunia kerja atau perguruan tinggi.',
            'Semoga kegiatan positif seperti ini dapat terus dipertahankan dan ditingkatkan kualitasnya pada tahun-tahun berikutnya. Terima kasih atas dukungan semua pihak yang telah mensukseskan jalannya acara ini.'
        ];

        $title = fake()->randomElement($indoTitles) . ' ' . fake()->unique()->numberBetween(1, 1000);
        
        // Randomly pick 3 paragraphs
        $contentParagraphs = fake()->randomElements($indoParagraphs, 3);

        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'excerpt' => $contentParagraphs[0],
            'content' => '<p>' . implode('</p><p>', $contentParagraphs) . '</p>',
            'image' => 'https://picsum.photos/seed/' . fake()->unique()->word() . '/800/600',
            'author_id' => \App\Models\User::factory(),
            'status' => 'published',
            'is_highlight' => fake()->boolean(20), // 20% chance of being highlighted
            'views' => fake()->numberBetween(10, 1000),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
