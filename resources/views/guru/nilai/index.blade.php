<x-admin-layout>
    @section('header', 'Nilai Siswa')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Nilai Siswa</h2>
            @if(auth()->user()->hasRole('walikelas'))
            <a href="{{ route('guru.nilai.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Input Nilai
            </a>
            @endif
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('guru.nilai.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-48">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari siswa atau mapel..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="subject_id" class="w-full md:w-40 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Mapel</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                <select name="classroom_id" class="w-full md:w-40 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Kelas</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Siswa</th>
                        <th class="py-3 px-4">Mata Pelajaran</th>
                        <th class="py-3 px-4">T.A</th>
                        <th class="py-3 px-4 text-center">Nilai Angka</th>
                        <th class="py-3 px-4">Keterangan</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($grades as $grade)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $grade->student?->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $grade->subject?->name }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $grade->academicYear?->name }}</td>
                        <td class="py-3 px-4 text-center font-bold {{ $grade->score < 75 ? 'text-red-500' : 'text-green-600' }}">
                            {{ $grade->score }}
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $grade->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">Data nilai tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($grades->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $grades->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
