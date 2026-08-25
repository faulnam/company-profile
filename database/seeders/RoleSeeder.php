<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleTU = Role::firstOrCreate(['name' => 'tu']);
        $roleGuru = Role::firstOrCreate(['name' => 'walikelas']);
        $roleWali = Role::firstOrCreate(['name' => 'walimurid']);

        // 1. Akun Asli (Password: qwertyu123)
        $admin = User::updateOrCreate(
            ['email' => 'admin@sekolah.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('qwertyu123')]
        );
        $admin->syncRoles([$roleAdmin]);

        $tu = User::updateOrCreate(
            ['email' => 'tu@sekolah.com'],
            ['name' => 'Staf Tata Usaha', 'password' => Hash::make('qwertyu123')]
        );
        $tu->syncRoles([$roleTU]);

        $guruName = 'Bpk. Budi (Wali Kelas)';
        $guru = User::updateOrCreate(
            ['email' => 'guru@sekolah.com'],
            ['name' => $guruName, 'password' => Hash::make('qwertyu123')]
        );
        $guru->syncRoles([$roleGuru]);

        Teacher::firstOrCreate(
            ['name' => $guruName],
            ['position' => 'Wali Kelas', 'subject' => 'Umum']
        );

        $walimurid = User::updateOrCreate(
            ['email' => 'wali@sekolah.com'],
            ['name' => 'Bpk. Ahmad (Ortu)', 'password' => Hash::make('qwertyu123')]
        );
        $walimurid->syncRoles([$roleWali]);

        // Link student to original wali if available
        Student::whereNull('parent_id')->orWhere('parent_id', 0)->take(2)->update(['parent_id' => $walimurid->id]);

        // 2. Akun Demo Tiap Role (Password: password)
        $demoAdmin = User::updateOrCreate(
            ['email' => 'demo_admin@sekolah.com'],
            ['name' => 'Demo Super Admin', 'password' => Hash::make('password')]
        );
        $demoAdmin->syncRoles([$roleAdmin]);

        $demoTu = User::updateOrCreate(
            ['email' => 'demo_tu@sekolah.com'],
            ['name' => 'Demo Tata Usaha', 'password' => Hash::make('password')]
        );
        $demoTu->syncRoles([$roleTU]);

        $demoGuruName = 'Demo Guru (Wali Kelas)';
        $demoGuru = User::updateOrCreate(
            ['email' => 'demo_guru@sekolah.com'],
            ['name' => $demoGuruName, 'password' => Hash::make('password')]
        );
        $demoGuru->syncRoles([$roleGuru]);

        Teacher::firstOrCreate(
            ['name' => $demoGuruName],
            ['position' => 'Wali Kelas Demo', 'subject' => 'Teknologi Informasi']
        );

        $demoWali = User::updateOrCreate(
            ['email' => 'demo_wali@sekolah.com'],
            ['name' => 'Demo Wali Murid', 'password' => Hash::make('password')]
        );
        $demoWali->syncRoles([$roleWali]);

        // Link student to demo wali
        Student::take(2)->update(['parent_id' => $demoWali->id]);
    }
}
