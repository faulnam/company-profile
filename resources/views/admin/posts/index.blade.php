<x-admin-layout>
    @section('header', 'Berita Sekolah')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Berita</h2>
            <a href="{{ route('admin.posts.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tulis Berita
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-6 mt-4 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="status" class="ml-2 border border-gray-300 rounded-lg text-sm py-2 px-3 focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                <select name="category" class="ml-2 border border-gray-300 rounded-lg text-sm py-2 px-3 focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4 w-20">Gambar</th>
                        <th class="py-3 px-4">Judul Berita</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($posts as $post)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4">
                            @if($post->image)
                                <img src="{{ $post->image }}" class="w-16 h-12 rounded object-cover border border-gray-200">
                            @else
                                <div class="w-16 h-12 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-gray-400 text-[10px]">No Img</div>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-gray-900 line-clamp-1 mb-1">{{ $post->title }}</div>
                            <div class="text-gray-500 text-xs">
                                <i class="fa-regular fa-clock mr-1"></i> {{ $post->created_at->format('d M Y') }}
                                &bull; <i class="fa-regular fa-eye ml-1 mr-1"></i> {{ $post->views }} views
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse($post->categories as $category)
                                    <span class="inline-block text-[10px] px-1.5 py-0.5 rounded text-white" style="background-color: {{ $category->color }}">{{ $category->name }}</span>
                                @empty
                                    <span class="text-gray-400 italic text-xs">Tanpa Kategori</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($post->status === 'published')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Published</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Draft</span>
                            @endif
                            @if($post->is_highlight)
                                <span class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-[10px] font-bold bg-yellow-100 text-yellow-800"><i class="fa-solid fa-star mr-1"></i> Highlight</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="/berita/{{ $post->slug }}" target="_blank" class="text-gray-500 hover:text-gray-700 p-1" title="Lihat">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 p-1" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">Belum ada berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($posts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
