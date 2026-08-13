<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID kelas anak-anak dari wali murid yang sedang login
        $studentClassroomIds = Student::where('parent_id', Auth::id())->pluck('classroom_id');

        // Tampilkan jadwal HANYA untuk kelas anak-anak tersebut
        $query = Schedule::whereIn('classroom_id', $studentClassroomIds)->with(['classroom', 'subject', 'teacher'])->latest();

        $classrooms = \App\Models\Classroom::whereIn('id', $studentClassroomIds)->get();
        $subjects = \App\Models\Subject::all();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('classroom', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })->orWhereHas('subject', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })->orWhereHas('teacher', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })->orWhere('day', 'like', "%{$search}%");
            });
        }

        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        if ($request->filled('subject')) {
            $query->where('subject_id', $request->subject);
        }

        $schedules = $query->paginate(10)->withQueryString();
        return view('wali.schedules.index', compact('schedules', 'classrooms', 'subjects'));
    }
}
