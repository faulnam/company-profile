<div x-data="{ activeTab: 'terbaru' }" class="bg-white border border-gray-200">
    <div class="flex border-b border-gray-200 bg-gray-50">
        <button @click="activeTab = 'terbaru'" :class="{ 'bg-white text-[#0f766e] font-bold border-t-2 border-[#0f766e]': activeTab === 'terbaru', 'text-gray-500 hover:bg-gray-100': activeTab !== 'terbaru' }" class="flex-1 py-3 text-[10px] sm:text-xs uppercase tracking-wider transition">Terbaru</button>
        <button @click="activeTab = 'populer'" :class="{ 'bg-white text-[#0f766e] font-bold border-t-2 border-[#0f766e]': activeTab === 'populer', 'text-gray-500 hover:bg-gray-100': activeTab !== 'populer' }" class="flex-1 py-3 text-[10px] sm:text-xs uppercase tracking-wider transition border-l border-r border-gray-200">Populer</button>
        <button @click="activeTab = 'trending'" :class="{ 'bg-white text-[#0f766e] font-bold border-t-2 border-[#0f766e]': activeTab === 'trending', 'text-gray-500 hover:bg-gray-100': activeTab !== 'trending' }" class="flex-1 py-3 text-[10px] sm:text-xs uppercase tracking-wider transition">Trending</button>
    </div>
    @php
        $tabTerbaru = \App\Models\Post::where('status', 'published')->latest()->take(4)->get();
        $tabPopuler = \App\Models\Post::where('status', 'published')->orderBy('views', 'desc')->take(4)->get();
        // Trending: Populer dalam 30 hari terakhir
        $tabTrending = \App\Models\Post::where('status', 'published')
                            ->where('created_at', '>=', now()->subDays(30))
                            ->orderBy('views', 'desc')->take(4)->get();
        
        // Fallback jika tidak ada post di bulan ini
        if($tabTrending->isEmpty()) {
            $tabTrending = $tabPopuler; 
        }
    @endphp

    <div class="p-4">
        <!-- Tab Content Terbaru -->
        <div x-show="activeTab === 'terbaru'" class="space-y-4">
            @forelse($tabTerbaru as $post)
            <div class="flex space-x-3 group border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                <div class="flex-shrink-0 w-24 h-16 bg-gray-200 overflow-hidden relative">
                    <img src="{{ $post->image }}" alt="thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-gray-800 leading-snug group-hover:text-school transition line-clamp-2"><a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="text-[10px] text-gray-500 mt-1"><i class="fa-regular fa-clock mr-1"></i> {{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
                <p class="text-xs text-gray-500 italic text-center py-2">Belum ada berita.</p>
            @endforelse
        </div>
        
        <!-- Tab Content Populer -->
        <div x-show="activeTab === 'populer'" class="space-y-4" style="display: none;">
            @forelse($tabPopuler as $post)
            <div class="flex space-x-3 group border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                <div class="flex-shrink-0 w-24 h-16 bg-gray-200 overflow-hidden relative">
                    <img src="{{ $post->image }}" alt="thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-gray-800 leading-snug group-hover:text-school transition line-clamp-2"><a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="text-[10px] text-gray-500 mt-1"><i class="fa-regular fa-eye mr-1"></i> {{ number_format($post->views) }}x dilihat</p>
                </div>
            </div>
            @empty
                <p class="text-xs text-gray-500 italic text-center py-2">Belum ada berita.</p>
            @endforelse
        </div>
        
        <!-- Tab Content Trending -->
        <div x-show="activeTab === 'trending'" class="space-y-4" style="display: none;">
            @forelse($tabTrending as $post)
            <div class="flex space-x-3 group border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                <div class="flex-shrink-0 w-24 h-16 bg-gray-200 overflow-hidden relative">
                    <img src="{{ $post->image }}" alt="thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-gray-800 leading-snug group-hover:text-school transition line-clamp-2"><a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a></h4>
                    <p class="text-[10px] text-gray-500 mt-1"><i class="fa-solid fa-fire text-orange-500 mr-1"></i> Sedang hangat</p>
                </div>
            </div>
            @empty
                <p class="text-xs text-gray-500 italic text-center py-2">Belum ada berita.</p>
            @endforelse
        </div>
    </div>
</div>
