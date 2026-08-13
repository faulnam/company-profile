<x-admin-layout>
    @section('header', 'Data Mata Pelajaran')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Mata Pelajaran</h2>
            @if(auth()->user()->hasRole('tu'))
            <a href="{{ route('tu.subjects.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Mapel
            </a>
            @endif
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('tu.subjects.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
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
                        <th class="py-3 px-4">Kode Mapel</th>
                        <th class="py-3 px-4">Nama Mata Pelajaran</th>
                        <th class="py-3 px-4">Tipe / Kelompok</th>
                        @if(auth()->user()->hasRole('tu'))
                        <th class="py-3 px-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($subjects as $subject)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-mono text-gray-600 bg-gray-50">{{ $subject->code }}</td>
                        <td class="py-3 px-4 font-bold text-gray-900">{{ $subject->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $subject->type }}</td>
                        @if(auth()->user()->hasRole('tu'))
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('tu.subjects.edit', $subject->id) }}" class="text-blue-500 hover:text-blue-700 p-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('tu.subjects.destroy', $subject->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mapel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Data mata pelajaran tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($subjects->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $subjects->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
