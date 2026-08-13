<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::where('is_active', true)->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $announcements = $query->paginate(10)->withQueryString();
        return view('wali.announcements.index', compact('announcements'));
    }
}
