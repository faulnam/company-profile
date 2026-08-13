<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        $subjects = $query->paginate(10)->withQueryString();
        return view('tu.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('tu.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code',
            'name' => 'required',
            'type' => 'required',
        ]);

        Subject::create($request->all());
        return redirect()->route('tu.subjects.index')->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        return view('tu.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code,' . $subject->id,
            'name' => 'required',
            'type' => 'required',
        ]);

        $subject->update($request->all());
        return redirect()->route('tu.subjects.index')->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('tu.subjects.index')->with('success', 'Mapel berhasil dihapus.');
    }
}
