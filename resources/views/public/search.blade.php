<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 shadow-sm border border-gray-100">
                <h1 class="text-xl font-bold text-gray-800 border-b-2 border-school pb-2 mb-6">Hasil Pencarian untuk: <span class="text-school">"{{ $query }}"</span></h1>
                
                @if($posts->count() > 0)
                    <!-- News Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($posts as $post)
                            <x-news.card :post="$post" />
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex justify-center pt-4 pb-8 border-t border-gray-100 mt-6">
                        {{ $posts->appends(['q' => $query])->links('pagination::tailwind') }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fa-solid fa-search text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Tidak Ada Hasil Ditemukan</h3>
                        <p class="text-sm text-gray-500">Maaf, kami tidak menemukan berita atau artikel dengan kata kunci "{{ $query }}". Silakan coba dengan kata kunci lain.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
