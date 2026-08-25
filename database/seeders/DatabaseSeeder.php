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
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Generate Users jika belum di-seed
        if (User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->count() <= 2) {
            User::factory(10)->create()->each(function ($user) {
                $user->assignRole('admin');
            });
        }
        
        if (User::whereHas('roles', fn($q) => $q->where('name', 'tu'))->count() <= 2) {
            User::factory(10)->create()->each(function ($user) {
                $user->assignRole('tu');
            });
        }

        if (User::whereHas('roles', fn($q) => $q->where('name', 'walikelas'))->count() <= 2) {
            User::factory(30)->create()->each(function ($user) {
                $user->assignRole('walikelas');
            });
        }

        if (User::whereHas('roles', fn($q) => $q->where('name', 'walimurid'))->count() <= 2) {
            User::factory(50)->create()->each(function ($user) {
                $user->assignRole('walimurid');
            });
        }

        // Generate Data Dummy jika belum ada
        if (\App\Models\Category::count() == 0) {
            \App\Models\Category::factory(8)->create();
        }

        if (\App\Models\Page::count() == 0) {
            \App\Models\Page::factory(10)->create();
        }

        if (\App\Models\Teacher::count() <= 2) {
            \App\Models\Teacher::factory(30)->create();
        }

        if (\App\Models\Major::count() == 0) {
            \App\Models\Major::factory(9)->create();
        }
        
        // Generate Academic Data
        if (\App\Models\AcademicYear::count() == 0) {
            \App\Models\AcademicYear::factory(5)->create();
        }

        if (\App\Models\Subject::count() == 0) {
            \App\Models\Subject::factory(30)->create();
        }

        if (\App\Models\Classroom::count() == 0) {
            \App\Models\Classroom::factory(30)->create();
        }

        if (\App\Models\Student::count() == 0) {
            \App\Models\Student::factory(100)->create();
        }
        
        // Pastikan akun wali memiliki anak (untuk pengujian)
        $defaultWali = User::where('email', 'wali@sekolah.com')->first();
        if ($defaultWali) {
            \App\Models\Student::take(2)->update(['parent_id' => $defaultWali->id]);
        }
        $demoWali = User::where('email', 'demo_wali@sekolah.com')->first();
        if ($demoWali) {
            \App\Models\Student::skip(2)->take(2)->update(['parent_id' => $demoWali->id]);
        }

        if (\App\Models\Schedule::count() == 0) {
            \App\Models\Schedule::factory(100)->create();
        }

        if (\App\Models\Announcement::count() == 0) {
            \App\Models\Announcement::factory(20)->create();
        }

        if (\App\Models\Attendance::count() == 0) {
            \App\Models\Attendance::factory(200)->create();
        }

        if (\App\Models\Grade::count() == 0) {
            \App\Models\Grade::factory(300)->create();
        }

        if (\App\Models\Invoice::count() == 0) {
            \App\Models\Invoice::factory(50)->create();
        }

        if (\App\Models\Registration::count() == 0) {
            \App\Models\Registration::factory(50)->create();
        }
        
        if (\App\Models\Post::count() == 0) {
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
}
