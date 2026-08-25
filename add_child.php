<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Student;
use App\Models\Invoice;
use App\Models\Classroom;

$walis = User::whereHas('roles', function($q) {
    $q->where('name', 'walimurid');
})->get();

if ($walis->isEmpty()) {
    echo "Tidak ada user dengan role walimurid ditemukan.\n";
    exit;
}

$classroom = Classroom::first();
if (!$classroom) {
    $classroom = Classroom::create([
        'name' => 'X IPA 1',
        'grade_id' => 1,
        'teacher_id' => 1,
    ]);
}

foreach ($walis as $wali) {
    $student = Student::firstOrCreate(
        ['parent_id' => $wali->id],
        [
            'nis' => rand(1000, 9999),
            'nisn' => rand(10000000, 99999999),
            'name' => 'Anak dari ' . $wali->name,
            'gender' => 'L',
            'birth_place' => 'Jakarta',
            'birth_date' => '2010-01-01',
            'address' => 'Jl. Test No. 1',
            'parent_phone' => '0812345678',
            'classroom_id' => $classroom->id ?? null,
        ]
    );

    echo "Siswa berhasil ditambahkan/dicek: " . $student->name . " untuk parent: " . $wali->name . "\n";

    $invoice = Invoice::firstOrCreate(
        [
            'student_id' => $student->id,
            'title' => 'SPP Agustus 2026',
        ],
        [
            'amount' => 250000,
            'is_paid' => false,
            'due_date' => '2026-08-30'
        ]
    );
    echo "Tagihan berhasil ditambahkan/dicek: " . $invoice->title . " untuk siswa: " . $student->name . "\n";
}
echo "Selesai.\n";
