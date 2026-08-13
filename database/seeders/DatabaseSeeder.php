<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan Role Seeder
        $this->call([
            RoleSeeder::class,
        ]);

        // Pengaturan Awal (Informasi Sekolah)
        $defaultSettings = [
            ['key' => 'school_name', 'value' => 'SMKN 1 CMI', 'type' => 'text'],
            ['key' => 'school_address', 'value' => 'Jl. Pendidikan No. 1, Kota CMI', 'type' => 'text'],
            ['key' => 'school_phone', 'value' => '(022) 1234567', 'type' => 'text'],
            ['key' => 'school_email', 'value' => 'info@smkn1cmi.sch.id', 'type' => 'text'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/smkn1cmi', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/smkn1cmi', 'type' => 'text'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/c/smkn1cmi', 'type' => 'text'],
        ];

        foreach ($defaultSettings as $setting) {
            \App\Models\Setting::create($setting);
        }

        // Generate Users
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('admin');
        });
        
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('tu');
        });

        User::factory(30)->create()->each(function ($user) {
            $user->assignRole('walikelas');
        });

        User::factory(50)->create()->each(function ($user) {
            $user->assignRole('walimurid');
        });

        // Generate Data Dummy
        \App\Models\Category::factory(8)->create();
        \App\Models\Page::factory(10)->create();
        \App\Models\Teacher::factory(30)->create();
        \App\Models\Major::factory(9)->create();
        
        // Generate Academic Data
        \App\Models\AcademicYear::factory(5)->create();
        \App\Models\Subject::factory(30)->create();
        \App\Models\Classroom::factory(30)->create();
        \App\Models\Student::factory(100)->create();
        
        // Pastikan akun wali@wali.com memiliki anak (untuk pengujian)
        $defaultWali = User::where('email', 'wali@wali.com')->first();
        if ($defaultWali) {
            \App\Models\Student::take(2)->update(['parent_id' => $defaultWali->id]);
        }

        \App\Models\Schedule::factory(100)->create();
        \App\Models\Announcement::factory(20)->create();
        \App\Models\Attendance::factory(200)->create();
        \App\Models\Grade::factory(300)->create();
        \App\Models\Invoice::factory(50)->create();
        \App\Models\Registration::factory(50)->create();
        
        // Generate 9 Highlighted Posts explicitly
        \App\Models\Post::factory(9)->create(['is_highlight' => true])->each(function ($post) {
            $post->categories()->attach(
                \App\Models\Category::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });

        // Generate 91 Normal Posts
        \App\Models\Post::factory(91)->create(['is_highlight' => false])->each(function ($post) {
            $post->categories()->attach(
                \App\Models\Category::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });
    }
}
