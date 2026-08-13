<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicYear::latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $academicYears = $query->paginate(10)->withQueryString();
        return view('admin.academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('admin.academic-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:academic_years',
            'is_active' => 'boolean',
        ]);

        if ($request->has('is_active')) {
            AcademicYear::where('is_active', true)->update(['is_active' => false]);
        } else {
            $validated['is_active'] = false;
        }

        AcademicYear::create($validated);

        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:academic_years,name,' . $academicYear->id,
            'is_active' => 'boolean',
        ]);

        if ($request->has('is_active')) {
            AcademicYear::where('id', '!=', $academicYear->id)->update(['is_active' => false]);
        } else {
            $validated['is_active'] = false;
        }

        $academicYear->update($validated);

        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun ajaran berhasil diupdate');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun ajaran berhasil dihapus');
    }
}
