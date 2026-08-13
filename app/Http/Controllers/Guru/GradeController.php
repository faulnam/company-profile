<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->first();
        
        $query = Grade::with(['student', 'subject', 'academicYear'])->latest();

        // Hanya tampilkan nilai dari siswa yang berada di kelas binaan Guru tersebut
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
            })->orWhereHas('subject', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('classroom_id')) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('classroom_id', $request->classroom_id);
            });
        }

        $grades = $query->paginate(15)->withQueryString();
        
        // Filter dropdown mapel dan kelas berdasarkan jadwal guru
        $schedules = \App\Models\Schedule::where('teacher_id', $teacher->id ?? 0)->with(['classroom', 'subject'])->get();
        $classrooms = $schedules->pluck('classroom')->unique('id');
        $subjects = $schedules->pluck('subject')->unique('id');
        
        return view('guru.nilai.index', compact('grades', 'subjects', 'classrooms'));
    }

    public function create(Request $request)
    {
        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->firstOrFail();
        
        $schedules = \App\Models\Schedule::where('teacher_id', $teacher->id)->with(['classroom', 'subject'])->get();
        $classrooms = $schedules->pluck('classroom')->unique('id');
        $subjects = $schedules->pluck('subject')->unique('id');
        $academicYears = \App\Models\AcademicYear::all();

        $students = collect();
        if ($request->filled('classroom_id')) {
            $students = \App\Models\Student::where('classroom_id', $request->classroom_id)->orderBy('name')->get();
        }

        return view('guru.nilai.create', compact('classrooms', 'subjects', 'academicYears', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'grades' => 'required|array',
            'grades.*.score' => 'required|numeric|min:0|max:100',
            'grades.*.notes' => 'nullable|string'
        ]);

        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->first();

        foreach ($request->grades as $studentId => $data) {
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $request->subject_id,
                    'academic_year_id' => $request->academic_year_id,
                ],
                [
                    'teacher_id' => $teacher->id ?? null,
                    'score' => $data['score'],
                    'notes' => $data['notes'] ?? null,
                ]
            );
        }

        return redirect()->route('guru.nilai.index')->with('success', 'Data nilai berhasil disimpan!');
    }
}
