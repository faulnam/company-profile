<x-admin-layout>
    @section('header', 'Detail Wali Murid')

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('tu.parents.index') }}" class="text-gray-500 hover:text-school transition flex items-center text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Wali Murid
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Informasi Wali Murid -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800">Profil Wali Murid</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center border-b border-gray-100 pb-6 mb-6">
                        <div class="w-24 h-24 rounded-full bg-gray-200 border-4 border-white shadow overflow-hidden flex items-center justify-center text-gray-400 mb-4">
                            <i class="fa-solid fa-user-tie text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 text-center">{{ $parent->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $parent->email }}</p>
                        <span class="mt-3 inline-block bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded border border-blue-200 uppercase font-bold tracking-wide">
                            WALI MURID
                        </span>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">ID Pengguna</h4>
                            <p class="text-sm font-medium text-gray-900">#{{ str_pad($parent->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Terdaftar Sejak</h4>
                            <p class="text-sm font-medium text-gray-900">{{ $parent->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Anak / Tanggungan -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-800">Data Anak (Siswa)</h2>
                    <span class="bg-school/10 text-school px-3 py-1 rounded-full text-xs font-bold">
                        {{ $children->count() }} Anak
                    </span>
                </div>
                <div class="p-0">
                    @if($children->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b border-gray-100">
                                        <th class="py-3 px-6">Nama Siswa</th>
                                        <th class="py-3 px-6">NIS / NISN</th>
                                        <th class="py-3 px-6">Kelas</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    @foreach($children as $child)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="py-4 px-6 font-bold text-gray-800">{{ $child->name }}</td>
                                        <td class="py-4 px-6">
                                            <div class="font-medium text-gray-900">{{ $child->nis }}</div>
                                            <div class="text-xs text-gray-500">{{ $child->nisn }}</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $child->classroom?->name ?? 'Belum ditentukan' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <a href="{{ route('tu.students.show', $child->id) }}" class="text-school hover:text-school-dark font-medium text-xs border border-school hover:bg-school hover:text-white px-3 py-1.5 rounded transition">
                                                Lihat Profil
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500 flex flex-col items-center">
                            <i class="fa-solid fa-user-slash text-4xl mb-3 text-gray-300"></i>
                            <p>Wali murid ini belum memiliki data anak yang terkait dalam sistem.</p>
                            <p class="text-sm mt-1">Pastikan data siswa sudah terisi dengan ID Orang Tua yang benar.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 flex items-start">
                <i class="fa-solid fa-circle-info text-blue-500 mt-0.5 mr-3"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-bold mb-1">Informasi Akun</p>
                    <p>Wali murid dapat login ke sistem (SiAkad Wali Murid) menggunakan email <strong>{{ $parent->email }}</strong> untuk memantau absensi, nilai, jadwal pelajaran, dan tagihan keuangan anak mereka.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
