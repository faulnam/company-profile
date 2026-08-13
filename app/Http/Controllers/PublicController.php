<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Page;
use App\Models\Teacher;
use App\Models\Major;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil berita highlight (maksimal 9 untuk 3 slide)
        $highlighted = Post::where('status', 'published')
            ->where(function($q) { $q->whereNull('published_at')->orWhere('published_at', '<=', now()); })
            ->where('is_highlight', true)->latest()->take(9)->get();
        
        // Fallback jika belum ada berita highlight
        if ($highlighted->count() == 0) {
            $highlighted = Post::where('status', 'published')
                ->where(function($q) { $q->whereNull('published_at')->orWhere('published_at', '<=', now()); })
                ->latest()->take(9)->get();
        }
        
        $heroSlides = $highlighted->chunk(3);
        $recentNews = Post::where('status', 'published')
            ->where(function($q) { $q->whereNull('published_at')->orWhere('published_at', '<=', now()); })
            ->latest()->paginate(10);

        return view('public.home', compact('heroSlides', 'recentNews'));
    }

    public function berita()
    {
        $posts = Post::where('status', 'published')
            ->where(function($q) { $q->whereNull('published_at')->orWhere('published_at', '<=', now()); })
            ->latest()->paginate(12);
        return view('public.berita.index', compact('posts'));
    }

    public function showBerita(Post $post)
    {
        $post->increment('views');
        return view('public.berita.show', compact('post'));
    }

    public function profil()
    {
        $page = Page::firstOrCreate(['slug' => 'profil-sekolah'], ['title' => 'Profil Sekolah', 'content' => '<p>Konten profil...</p>']);
        return view('public.page.show', compact('page'));
    }

    public function page($slug)
    {
        $title = ucwords(str_replace('-', ' ', $slug));
        $page = Page::firstOrCreate(['slug' => $slug], ['title' => $title, 'content' => "<p>Konten halaman {$title} sedang dalam pengembangan...</p>"]);
        return view('public.page.show', compact('page'));
    }

    public function jurusan()
    {
        $majors = Major::all();
        return view('public.jurusan.index', compact('majors'));
    }

    public function gtk()
    {
        $teachers = Teacher::paginate(20);
        return view('public.gtk.index', compact('teachers'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $posts = Post::where('status', 'published')
            ->where(function($q) { $q->whereNull('published_at')->orWhere('published_at', '<=', now()); })
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })->latest()->paginate(10);
            
        return view('public.search', compact('posts', 'query'));
    }
}
