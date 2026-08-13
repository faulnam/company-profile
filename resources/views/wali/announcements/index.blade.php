<x-admin-layout>
    @section('header', 'Pengumuman Sekolah')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Papan Pengumuman</h2>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('wali.announcements.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <button type="submit" class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Cari</button>
            </form>
        </div>

        <div class="p-6">
            <div class="space-y-4">
                @forelse($announcements as $announcement)
                <div class="bg-blue-50/50 border border-blue-100 rounded-lg p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $announcement->title }}</h3>
                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded border border-gray-200">
                            {{ $announcement->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <div class="text-gray-700 text-sm leading-relaxed prose">
                        {{ $announcement->content }}
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fa-regular fa-bell-slash text-4xl mb-3 text-gray-300"></i>
                    <p>Belum ada pengumuman baru untuk saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
        
        @if($announcements->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
