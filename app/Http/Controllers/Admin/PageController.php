<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::latest();
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        
        $pages = $query->paginate(10)->withQueryString();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pages', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil ditambahkan');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($page->image && !str_starts_with($page->image, 'http')) {
                $oldPath = str_replace('/storage/', '', $page->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('pages', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diupdate');
    }

    public function destroy(Page $page)
    {
        if ($page->image && !str_starts_with($page->image, 'http')) {
            $oldPath = str_replace('/storage/', '', $page->image);
            Storage::disk('public')->delete($oldPath);
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus');
    }
}
