<x-admin-layout>
    @section('header', 'Jadwal Pelajaran Anak')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Jadwal Kelas</h2>
            <span class="text-sm text-gray-500 italic">Mode Read-Only</span>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('wali.schedules.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari hari atau mapel..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="classroom" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Kelas Anak</option>
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ request('classroom') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                <select name="subject" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Mapel</option>
                    @foreach($subjects as $sub)
                        <option value="{{ $sub->id }}" {{ request('subject') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
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
                        <th class="py-3 px-4">Guru Pengajar</th>
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
                        <td class="py-3 px-4 text-gray-700">{{ $schedule->teacher?->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">Belum ada jadwal untuk kelas anak Anda.</td>
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
