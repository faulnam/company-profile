<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $query = Attendance::with('student')
                 ->whereHas('student', function($q) use ($userId) {
                     $q->where('parent_id', $userId);
                 })
                 ->latest();

        if ($request->filled('search')) {
            $query->where('notes', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->paginate(15)->withQueryString();
        return view('wali.absensi.index', compact('attendances'));
    }
}
