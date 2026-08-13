<x-public-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content (Berita) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 shadow-sm border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 border-b-2 border-school pb-2 mb-6 uppercase">Indeks Berita</h1>
                
                <!-- News Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($posts as $post)
                        <x-news.card :post="$post" />
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-center pt-4 pb-8 border-t border-gray-100 mt-6">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <x-sidebar.main />
        </div>
        
    </div>
</x-public-layout>
