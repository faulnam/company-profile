<x-admin-layout>
    @section('header', 'Absensi Siswa')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Riwayat Kehadiran Siswa</h2>
            @if(auth()->user()->hasRole('walikelas'))
            <a href="{{ route('guru.absensi.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-clipboard-user mr-2"></i> Input Absensi
            </a>
            @endif
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('guru.absensi.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="status" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Status</option>
                    <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Alpa" {{ request('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Siswa</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Status</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($attendances as $attendance)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $attendance->student?->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            @if($attendance->status == 'Hadir')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">{{ $attendance->status }}</span>
                            @elseif($attendance->status == 'Alpa')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">{{ $attendance->status }}</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">{{ $attendance->status }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $attendance->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Data absensi tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($attendances->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $attendances->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
