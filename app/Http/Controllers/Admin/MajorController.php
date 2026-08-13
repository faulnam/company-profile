<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Major;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $query = Major::latest();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('acronym', 'like', '%' . $request->search . '%')
                  ->orWhere('head_of_major', 'like', '%' . $request->search . '%');
        }
        
        $majors = $query->paginate(10)->withQueryString();
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        $teachers = \App\Models\Teacher::all();
        return view('admin.majors.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:10',
            'description' => 'required|string',
            'head_of_major' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('majors', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        Major::create($validated);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit(Major $major)
    {
        $teachers = \App\Models\Teacher::all();
        return view('admin.majors.edit', compact('major', 'teachers'));
    }

    public function update(Request $request, Major $major)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:10',
            'description' => 'required|string',
            'head_of_major' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($major->image && !str_starts_with($major->image, 'http')) {
                $oldPath = str_replace('/storage/', '', $major->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('majors', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $major->update($validated);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy(Major $major)
    {
        if ($major->image && !str_starts_with($major->image, 'http')) {
            $oldPath = str_replace('/storage/', '', $major->image);
            Storage::disk('public')->delete($oldPath);
        }
        $major->delete();
        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
