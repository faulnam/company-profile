<div class="bg-white border border-gray-200 mt-6">
    <h3 class="bg-[#0f766e] text-white text-sm font-bold px-4 py-2 uppercase tracking-wider mb-4 border-l-4 border-[#14b8a6]">Berita Terkini</h3>
    <div class="space-y-4 px-4 pb-4">
        @php
            $sidebarRecentPosts = \App\Models\Post::where('status', 'published')->latest()->take(6)->get();
        @endphp
        
        @foreach($sidebarRecentPosts as $post)
        <div class="flex space-x-3 group">
            <div class="flex-shrink-0 w-20 h-16 bg-gray-200 overflow-hidden">
                <img src="{{ $post->image }}" alt="thumb" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gray-800 leading-snug group-hover:text-school transition line-clamp-2">
                    <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
                </h4>
                <p class="text-[10px] text-gray-500 mt-1">{{ $post->created_at->translatedFormat('d F Y') }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
