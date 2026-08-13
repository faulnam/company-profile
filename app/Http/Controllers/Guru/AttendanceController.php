<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->first();
        
        $query = Attendance::with('student')->latest();

        // Hanya tampilkan absensi dari siswa yang berada di kelas binaan Guru tersebut
        if ($teacher) {
            $classroom = \App\Models\Classroom::where('teacher_id', $teacher->id)->first();
            if ($classroom) {
                $query->whereHas('student', function($q) use ($classroom) {
                    $q->where('classroom_id', $classroom->id);
                });
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->paginate(15)->withQueryString();
        return view('guru.absensi.index', compact('attendances'));
    }

    public function create(Request $request)
    {
        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->firstOrFail();
        
        // Dapatkan jadwal mengajar untuk dropdown
        $schedules = \App\Models\Schedule::where('teacher_id', $teacher->id)->with(['classroom', 'subject'])->get();
        
        $classrooms = $schedules->pluck('classroom')->unique('id');
        $subjects = $schedules->pluck('subject')->unique('id');

        $students = collect();
        if ($request->filled('classroom_id')) {
            $students = \App\Models\Student::where('classroom_id', $request->classroom_id)->orderBy('name')->get();
        }

        return view('guru.absensi.create', compact('classrooms', 'subjects', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'classroom_id' => 'required|exists:classrooms,id',
            'attendances' => 'required|array',
            'attendances.*.status' => 'required|in:Hadir,Sakit,Izin,Alpa',
            'attendances.*.notes' => 'nullable|string'
        ]);

        $date = $request->date;

        foreach ($request->attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $date
                ],
                [
                    'status' => $data['status'],
                    'notes' => $data['notes'] ?? null,
                ]
            );
        }

        return redirect()->route('guru.absensi.index')->with('success', 'Data absensi berhasil disimpan!');
    }
}
