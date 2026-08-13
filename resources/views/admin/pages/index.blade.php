<x-admin-layout>
    @section('header', 'Halaman Statis')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Halaman Statis</h2>
            <a href="{{ route('admin.pages.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Halaman
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
            <form action="{{ route('admin.pages.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari halaman..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <button type="submit" class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Cari</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4 w-16">Header</th>
                        <th class="py-3 px-4">Judul Halaman</th>
                        <th class="py-3 px-4">Slug / URL</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($pages as $page)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4">
                            @if($page->image)
                                <img src="{{ $page->image }}" alt="{{ $page->title }}" class="w-12 h-8 rounded object-cover border border-gray-200">
                            @else
                                <div class="w-12 h-8 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-gray-400 text-xs">No Img</div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-bold text-gray-900">{{ $page->title }}</td>
                        <td class="py-3 px-4 text-gray-500">
                            <a href="/halaman/{{ $page->slug }}" target="_blank" class="text-school hover:underline">/halaman/{{ $page->slug }}</a>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-blue-500 hover:text-blue-700 p-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus halaman statis ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada data halaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pages->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $pages->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
