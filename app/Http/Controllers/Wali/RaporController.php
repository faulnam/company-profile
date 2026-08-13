<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class RaporController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $query = Grade::with(['student', 'subject', 'academicYear'])
                 ->whereHas('student', function($q) use ($userId) {
                     $q->where('parent_id', $userId);
                 })
                 ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('subject', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $grades = $query->paginate(15)->withQueryString();
        return view('wali.rapor.index', compact('grades'));
    }

    public function print($id)
    {
        $userId = auth()->id();
        $grade = Grade::with(['student', 'subject', 'academicYear', 'teacher'])
                 ->where('id', $id)
                 ->whereHas('student', function($q) use ($userId) {
                     $q->where('parent_id', $userId);
                 })
                 ->firstOrFail();

        return view('guru.rapor.print', compact('grade'));
    }
}
