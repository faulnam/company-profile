<x-admin-layout>
    @section('header', 'Manajemen Jurusan')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Jurusan</h2>
            <a href="{{ route('admin.majors.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Jurusan
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
            <form action="{{ route('admin.majors.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jurusan..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
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
                        <th class="py-3 px-4 w-16">Ikon</th>
                        <th class="py-3 px-4">Nama Jurusan</th>
                        <th class="py-3 px-4">Kepala Program</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($majors as $major)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4">
                            <img src="{{ $major->image ?? 'https://via.placeholder.com/150' }}" alt="{{ $major->acronym }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-gray-900">{{ $major->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $major->acronym }}</div>
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            {{ $major->head_of_major ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.majors.edit', $major->id) }}" class="text-blue-500 hover:text-blue-700 p-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data jurusan ini?');">
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
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada data jurusan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($majors->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $majors->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
