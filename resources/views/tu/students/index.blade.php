<x-admin-layout>
    @section('header', 'Data Siswa')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Siswa</h2>
            @if(auth()->user()->hasRole('tu'))
            <button class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Siswa
            </button>
            @endif
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('tu.students.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIS..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="classroom" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Kelas</option>
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ request('classroom') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">NIS / NISN</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">L/P</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4">Orang Tua</th>
                        @if(auth()->user()->hasRole('tu'))
                        <th class="py-3 px-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($students as $student)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-900">{{ $student->nis }}</div>
                            <div class="text-xs text-gray-500">{{ $student->nisn }}</div>
                        </td>
                        <td class="py-3 px-4 font-bold text-school hover:underline">
                            <a href="{{ route('tu.students.show', $student->id) }}">{{ $student->name }}</a>
                        </td>
                        <td class="py-3 px-4">{{ $student->gender }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $student->classroom?->name ?? '-' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ $student->parent?->name ?? '-' }}</td>
                        @if(auth()->user()->hasRole('tu'))
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('tu.students.show', $student->id) }}" class="text-green-500 hover:text-green-700 p-1" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">Data siswa tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($students->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
