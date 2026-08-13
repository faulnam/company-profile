<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('origin_school', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $registrations = $query->paginate(15)->withQueryString();
        return view('tu.ppdb.index', compact('registrations'));
    }

    public function accept(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        if ($registration->status != 'Pending') {
            return back()->with('error', 'Status pendaftaran sudah diproses.');
        }

        DB::beginTransaction();
        try {
            // 1. Buat Akun Wali Murid
            $user = User::firstOrCreate(
                ['email' => $registration->parent_email],
                [
                    'name' => $registration->parent_name,
                    'password' => $registration->parent_password ?? Hash::make('password123'), // Fallback
                ]
            );
            
            // Berikan role walimurid jika belum punya
            if (!$user->hasRole('walimurid')) {
                $user->assignRole('walimurid');
            }

            // 2. Buat Data Siswa
            // Cari kelas 10 untuk jurusan yang dipilih, cari yang jumlah siswanya paling sedikit
            $classroom = Classroom::where('major_id', $registration->major_id)
                ->where(function($q) {
                    $q->where('name', 'like', '%10%')
                      ->orWhere('name', 'like', '%X %')
                      ->orWhere('name', 'like', 'X%');
                })
                ->withCount('students')
                ->orderBy('students_count', 'asc')
                ->first();
            
            if (!$classroom) {
                // Fallback jika tidak ada kelas 10, ambil sembarang kelas jurusan itu yang paling sedikit siswanya
                $classroom = Classroom::where('major_id', $registration->major_id)
                    ->withCount('students')
                    ->orderBy('students_count', 'asc')
                    ->first();
            }
            
            Student::create([
                'name' => $registration->name,
                'nis' => 'S' . date('Ymd') . rand(100, 999),
                'nisn' => rand(1000000000, 9999999999),
                'gender' => 'L', // Default, bisa diubah (L/P)
                'birth_place' => 'Jakarta',
                'birth_date' => '2010-01-01',
                'address' => 'Alamat dari pendaftaran',
                'parent_id' => $user->id,
                'classroom_id' => $classroom ? $classroom->id : null,
            ]);

            // 3. Update Status Pendaftaran
            $registration->update(['status' => 'Diterima']);
            
            DB::commit();
            return back()->with('success', 'Pendaftaran diterima. Akun Wali Murid dan Data Siswa berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        $registration->update(['status' => 'Ditolak']);
        return back()->with('success', 'Pendaftaran ditolak.');
    }

    public function exportCsv(Request $request)
    {
        $query = Registration::latest();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $registrations = $query->get();

        $filename = "ppdb_export_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID', 'Nama', 'Email Ortu', 'No HP', 'Asal Sekolah', 'Nilai', 'Status', 'Tanggal Daftar');

        $callback = function() use($registrations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($registrations as $reg) {
                $row['ID']  = $reg->id;
                $row['Nama'] = $reg->name;
                $row['Email Ortu'] = $reg->parent_email;
                $row['No HP'] = $reg->phone;
                $row['Asal Sekolah'] = $reg->origin_school;
                $row['Nilai'] = $reg->average_grade;
                $row['Status'] = $reg->status;
                $row['Tanggal Daftar'] = $reg->created_at->format('Y-m-d H:i:s');

                fputcsv($file, array($row['ID'], $row['Nama'], $row['Email Ortu'], $row['No HP'], $row['Asal Sekolah'], $row['Nilai'], $row['Status'], $row['Tanggal Daftar']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        // Simple print view for PDF export fallback
        $query = Registration::latest();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $registrations = $query->get();

        return view('tu.ppdb.print', compact('registrations'));
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
