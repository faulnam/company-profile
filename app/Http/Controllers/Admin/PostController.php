<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('categories')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $category = $request->category;
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('categories.id', $category);
            });
        }

        $posts = $query->paginate(10)->withQueryString();
        $categories = Category::all();
        
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = Auth::id() ?? 1;
        $validated['is_highlight'] = $request->has('is_highlight');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $post = Post::create($validated);
        
        if (isset($validated['categories'])) {
            $post->categories()->sync($validated['categories']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_highlight'] = $request->has('is_highlight');

        if ($request->hasFile('image')) {
            if ($post->image && !str_starts_with($post->image, 'http')) {
                $oldPath = str_replace('/storage/', '', $post->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $post->update($validated);
        
        if (isset($validated['categories'])) {
            $post->categories()->sync($validated['categories']);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diupdate');
    }

    public function destroy(Post $post)
    {
        if ($post->image && !str_starts_with($post->image, 'http')) {
            $oldPath = str_replace('/storage/', '', $post->image);
            Storage::disk('public')->delete($oldPath);
        }
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus');
    }
}
