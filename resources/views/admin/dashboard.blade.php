<x-admin-layout>
    @section('header', 'Dashboard')
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stats Card 1 -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 text-gray-800 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ \App\Models\Post::count() }}</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Total Berita</p>
            </div>
        </div>
        
        <!-- Stats Card 2 -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 text-gray-800 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ \App\Models\Teacher::count() }}</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Total GTK</p>
            </div>
        </div>
        
        <!-- Stats Card 3 -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 text-gray-800 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ \App\Models\Major::count() }}</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Total Jurusan</p>
            </div>
        </div>
        
        <!-- Stats Card 4 -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 text-gray-800 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-eye"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ \App\Models\Post::sum('views') }}</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Total Views Berita</p>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
            <h2 class="text-sm font-bold text-gray-800">Berita Terbaru</h2>
            <a href="{{ route('admin.posts.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Lihat Semua</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 text-[10px] font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-6">Judul Berita</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse(\App\Models\Post::latest()->take(5)->get() as $post)
                    <tr class="hover:bg-gray-50/30 transition">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-100 rounded mr-3 overflow-hidden flex-shrink-0 border border-gray-200">
                                    <img src="{{ $post->image ?? 'https://via.placeholder.com/150' }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <span class="font-medium text-gray-800 text-sm line-clamp-1">{{ $post->title }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($post->status === 'published')
                                <i class="fa-solid fa-circle-check text-gray-800 text-lg"></i>
                            @else
                                <i class="fa-solid fa-circle text-gray-300 text-lg"></i>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-gray-500 text-xs font-medium">
                            {{ $post->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center text-gray-500 text-sm">Belum ada berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
