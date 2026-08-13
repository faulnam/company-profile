<x-admin-layout>
    @section('header', 'PPDB')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Penerimaan Peserta Didik Baru (PPDB)</h2>
            <div class="flex gap-2">
                <a href="{{ route('tu.ppdb.export.pdf', request()->all()) }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                    <i class="fa-solid fa-file-pdf mr-2"></i> Cetak / Export PDF
                </a>
                <a href="{{ route('tu.ppdb.export.csv', request()->all()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                    <i class="fa-solid fa-file-excel mr-2"></i> Export Excel (CSV)
                </a>
            </div>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('tu.ppdb.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama calon siswa..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="status" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Calon Siswa</th>
                        <th class="py-3 px-4">Asal Sekolah</th>
                        <th class="py-3 px-4">No. HP / Telepon</th>
                        <th class="py-3 px-4">Status</th>
                        @if(auth()->user()->hasRole('tu'))
                        <th class="py-3 px-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $reg->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $reg->origin_school }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $reg->phone }}</td>
                        <td class="py-3 px-4">
                            @if($reg->status == 'Diterima')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ $reg->status }}</span>
                            @elseif($reg->status == 'Ditolak')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">{{ $reg->status }}</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">{{ $reg->status }}</span>
                            @endif
                        </td>
                        @if(auth()->user()->hasRole('tu'))
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if($reg->status == 'Pending')
                                <form action="{{ route('tu.ppdb.accept', $reg->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 p-1" title="Terima">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('tu.ppdb.reject', $reg->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-1" title="Tolak">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                                @endif
                                <!-- <button class="text-blue-500 hover:text-blue-700 p-1 ml-2 border-l border-gray-200 pl-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button> -->
                                <form action="{{ route('tu.ppdb.destroy', $reg->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pendaftar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1 ml-2 border-l border-gray-200 pl-2">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">Belum ada pendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($registrations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
