<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Filter Jadwal hanya untuk Guru yang sedang login
        $teacher = \App\Models\Teacher::where('name', auth()->user()->name)->first();
        
        $query = Schedule::with(['classroom', 'subject', 'teacher'])
            ->when($teacher, function ($q) use ($teacher) {
                return $q->where('teacher_id', $teacher->id);
            })
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('classroom', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('subject', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('day', 'like', "%{$search}%");
            });
        }

        $schedules = $query->paginate(10)->withQueryString();
        return view('guru.schedules.index', compact('schedules'));
    }
}
