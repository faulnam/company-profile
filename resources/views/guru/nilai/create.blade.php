<x-admin-layout>
    @section('header', 'Input Nilai Siswa')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Form Input Nilai Massal</h2>
            <a href="{{ route('guru.nilai.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
        </div>

        <div class="p-6">
            <form action="{{ route('guru.nilai.create') }}" method="GET" class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                        <select name="academic_year_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                            <option value="">Pilih T.A.</option>
                            @foreach($academicYears as $ay)
                                <option value="{{ $ay->id }}" {{ request('academic_year_id') == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                        <select name="subject_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                            <option value="">Pilih Mapel</option>
                            @foreach($subjects as $sub)
                                <option value="{{ $sub->id }}" {{ request('subject_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        </select>
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

            @if(request()->filled('classroom_id') && request()->filled('subject_id') && request()->filled('academic_year_id'))
                <form action="{{ route('guru.nilai.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="academic_year_id" value="{{ request('academic_year_id') }}">
                    <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                    <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse mb-6">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                                    <th class="py-3 px-4 w-12 text-center">No</th>
                                    <th class="py-3 px-4">Nama Siswa</th>
                                    <th class="py-3 px-4 w-48">Nilai Angka (0-100)</th>
                                    <th class="py-3 px-4">Catatan (Opsional)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($students as $index => $student)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-3 px-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4 font-bold text-gray-800">{{ $student->name }}</td>
                                    <td class="py-3 px-4">
                                        <input type="number" name="grades[{{ $student->id }}][score]" min="0" max="100" required placeholder="0" class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school text-center font-bold">
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="grades[{{ $student->id }}][notes]" placeholder="Keterangan..." class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
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
                            <i class="fa-solid fa-save mr-2"></i> Simpan Nilai
                        </button>
                    </div>
                    @endif
                </form>
            @elseif(request()->has('classroom_id'))
                <div class="text-center py-10 bg-yellow-50 rounded-lg border border-dashed border-yellow-300">
                    <i class="fa-solid fa-triangle-exclamation text-4xl text-yellow-400 mb-3"></i>
                    <p class="text-yellow-700">Silakan lengkapi pilihan Tahun Ajaran, Mapel, dan Kelas terlebih dahulu.</p>
                </div>
            @else
                <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                    <i class="fa-solid fa-list-check text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Pilih pengaturan T.A., Mapel, dan Kelas di atas untuk memuat form nilai.</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
