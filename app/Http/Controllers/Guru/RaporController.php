<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class RaporController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('classroom')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
        }

        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        $students = $query->paginate(15)->withQueryString();
        $classrooms = \App\Models\Classroom::all();
        
        return view('guru.rapor.index', compact('students', 'classrooms'));
    }

    public function print(Request $request, $student_id)
    {
        $student = Student::with(['classroom', 'parent'])->findOrFail($student_id);
        $academicYear = \App\Models\AcademicYear::where('is_active', true)->first();
        
        $grades = \App\Models\Grade::with('subject')
            ->where('student_id', $student_id)
            ->where('academic_year_id', $academicYear?->id)
            ->get();
            
        return view('guru.rapor.print', compact('student', 'academicYear', 'grades'));
    }
}
