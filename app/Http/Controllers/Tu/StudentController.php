<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['classroom', 'parent'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
        }

        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        $students = $query->paginate(10)->withQueryString();
        $classrooms = \App\Models\Classroom::all();
        return view('tu.students.index', compact('students', 'classrooms'));
    }

    public function show(Student $student)
    {
        $student->load(['classroom', 'parent']);
        return view('tu.students.show', compact('student'));
    }
}
