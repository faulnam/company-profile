<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $query = Classroom::with(['major', 'teacher'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('major_id')) {
            $query->where('major_id', $request->major_id);
        }

        $classrooms = $query->paginate(10)->withQueryString();
        $majors = \App\Models\Major::all();
        
        return view('tu.classrooms.index', compact('classrooms', 'majors'));
    }

    public function create()
    {
        $majors = \App\Models\Major::all();
        $teachers = \App\Models\Teacher::all();
        $subjects = \App\Models\Subject::all();
        return view('tu.classrooms.create', compact('majors', 'teachers', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $classroom = Classroom::create([
            'name' => $validated['name'],
            'major_id' => $validated['major_id'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        if (isset($validated['subjects'])) {
            $classroom->subjects()->sync($validated['subjects']);
        }

        return redirect()->route('tu.classrooms.index')->with('success', 'Kelas berhasil ditambahkan beserta mata pelajarannya.');
    }

    public function edit(Classroom $classroom)
    {
        $majors = \App\Models\Major::all();
        $teachers = \App\Models\Teacher::all();
        $subjects = \App\Models\Subject::all();
        $classroom->load('subjects');
        return view('tu.classrooms.edit', compact('classroom', 'majors', 'teachers', 'subjects'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $classroom->update([
            'name' => $validated['name'],
            'major_id' => $validated['major_id'],
            'teacher_id' => $validated['teacher_id'],
        ]);

        if (isset($validated['subjects'])) {
            $classroom->subjects()->sync($validated['subjects']);
        } else {
            $classroom->subjects()->sync([]);
        }

        return redirect()->route('tu.classrooms.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('tu.classrooms.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
