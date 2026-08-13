<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::latest();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('position', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
        }
        
        $teachers = $query->paginate(10)->withQueryString();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = \App\Models\Subject::all();
        return view('admin.teachers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'position' => 'required|string|max:100',
            'subjects' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (isset($validated['subjects'])) {
            $validated['subject'] = implode(', ', $validated['subjects']);
            unset($validated['subjects']);
        } else {
            $validated['subject'] = null;
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        Teacher::create($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Data Guru berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $subjects = \App\Models\Subject::all();
        return view('admin.teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'position' => 'required|string|max:100',
            'subjects' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (isset($validated['subjects'])) {
            $validated['subject'] = implode(', ', $validated['subjects']);
            unset($validated['subjects']);
        } else {
            $validated['subject'] = null;
        }

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada dan bukan bawaan placeholder url
            if ($teacher->photo && !str_starts_with($teacher->photo, 'http')) {
                $oldPath = str_replace('/storage/', '', $teacher->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = '/storage/' . $path;
        }

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Data Guru berhasil diupdate');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo && !str_starts_with($teacher->photo, 'http')) {
            $oldPath = str_replace('/storage/', '', $teacher->photo);
            Storage::disk('public')->delete($oldPath);
        }
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Data Guru berhasil dihapus');
    }
}
