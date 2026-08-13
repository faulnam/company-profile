<x-admin-layout>
    @section('header', 'Input Absensi Siswa')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Form Input Absensi</h2>
            <a href="{{ route('guru.absensi.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
        </div>

        <div class="p-6">
            <form action="{{ route('guru.absensi.create') }}" method="GET" class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select name="classroom_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                            <option value="">Pilih Kelas</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}" {{ request('classroom_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Tampilkan Siswa
                        </button>
                    </div>
                </div>
            </form>

            @if(request()->filled('classroom_id'))
                <form action="{{ route('guru.absensi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="date" value="{{ request('date') }}">
                    <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse mb-6">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                                    <th class="py-3 px-4 w-12 text-center">No</th>
                                    <th class="py-3 px-4">Nama Siswa</th>
                                    <th class="py-3 px-4">Status Kehadiran</th>
                                    <th class="py-3 px-4">Catatan (Opsional)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($students as $index => $student)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-3 px-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 font-bold text-gray-800">{{ $student->name }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-4">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="attendances[{{ $student->id }}][status]" value="Hadir" class="text-green-600 focus:ring-green-500" checked>
                                                <span class="ml-2 text-gray-700">Hadir</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="attendances[{{ $student->id }}][status]" value="Sakit" class="text-blue-600 focus:ring-blue-500">
                                                <span class="ml-2 text-gray-700">Sakit</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="attendances[{{ $student->id }}][status]" value="Izin" class="text-yellow-600 focus:ring-yellow-500">
                                                <span class="ml-2 text-gray-700">Izin</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="attendances[{{ $student->id }}][status]" value="Alpa" class="text-red-600 focus:ring-red-500">
                                                <span class="ml-2 text-gray-700">Alpa</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="attendances[{{ $student->id }}][notes]" placeholder="Keterangan tambahan..." class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">Tidak ada siswa di kelas ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($students->isNotEmpty())
                    <div class="flex justify-end">
                        <button type="submit" class="bg-school hover:bg-school-dark text-white px-6 py-2.5 rounded-lg text-sm font-medium transition flex items-center">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Absensi
                        </button>
                    </div>
                    @endif
                </form>
            @else
                <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                    <i class="fa-solid fa-users text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Pilih tanggal dan kelas terlebih dahulu untuk memuat daftar siswa.</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
