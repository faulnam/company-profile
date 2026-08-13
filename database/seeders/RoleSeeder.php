<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Roles
        $roleAdmin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $roleTU = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'tu']);
        $roleGuru = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'walikelas']);
        $roleWali = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'walimurid']);

        // Create Admin User
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@sekolah.com'],
            ['name' => 'Super Admin', 'password' => bcrypt('admin123')]
        );
        $admin->assignRole($roleAdmin);

        // Create TU User
        $tu = \App\Models\User::firstOrCreate(
            ['email' => 'tu@sekolah.com'],
            ['name' => 'Staf Tata Usaha', 'password' => bcrypt('tu123')]
        );
        $tu->assignRole($roleTU);

        // Create Guru User
        $guruName = 'Bpk. Budi (Wali Kelas)';
        $guru = \App\Models\User::firstOrCreate(
            ['email' => 'guru@sekolah.com'],
            ['name' => $guruName, 'password' => bcrypt('guru123')]
        );
        $guru->assignRole($roleGuru);

        // Ensure this Guru exists in teachers table
        \App\Models\Teacher::firstOrCreate(
            ['name' => $guruName],
            ['position' => 'Wali Kelas', 'subject' => 'Umum']
        );

        // Create Wali Murid User
        $walimurid = \App\Models\User::firstOrCreate(
            ['email' => 'wali@sekolah.com'],
            ['name' => 'Bpk. Ahmad (Ortu)', 'password' => bcrypt('wali123')]
        );
        $walimurid->assignRole($roleWali);
    }
}
