<x-admin-layout>
    @section('header', 'Jadwal Mengajar Anda')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Jadwal Mengajar</h2>
            <span class="text-sm text-gray-500 italic">Mode Read-Only</span>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('guru.schedules.index') }}" method="GET" class="flex items-center w-full md:w-auto">
                <div class="relative w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kelas, hari, atau mapel..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
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
                        <th class="py-3 px-4">Hari</th>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4">Mata Pelajaran</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($schedules as $schedule)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $schedule->day }}</td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </td>
                        <td class="py-3 px-4 text-blue-700 font-medium">{{ $schedule->classroom?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $schedule->subject?->name }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">Anda belum memiliki jadwal mengajar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($schedules->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $schedules->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
