<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['classroom', 'subject', 'teacher'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('classroom', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('subject', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('teacher', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('day', 'like', "%{$search}%");
        }

        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        $schedules = $query->paginate(10)->withQueryString();
        $classrooms = \App\Models\Classroom::all();
        return view('tu.schedules.index', compact('schedules', 'classrooms'));
    }

    public function create()
    {
        $classrooms = \App\Models\Classroom::all();
        $subjects = \App\Models\Subject::all();
        $teachers = \App\Models\Teacher::all();
        return view('tu.schedules.create', compact('classrooms', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::create($request->all());
        return redirect()->route('tu.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $classrooms = \App\Models\Classroom::all();
        $subjects = \App\Models\Subject::all();
        $teachers = \App\Models\Teacher::all();
        return view('tu.schedules.edit', compact('schedule', 'classrooms', 'subjects', 'teachers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule->update($request->all());
        return redirect()->route('tu.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('tu.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
