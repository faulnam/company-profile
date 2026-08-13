<x-admin-layout>
    @section('header', 'Detail Siswa')

    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('tu.students.index') }}" class="text-gray-500 hover:text-school transition flex items-center text-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Data Siswa
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Detail Profil Siswa</h2>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $student->classroom ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $student->classroom ? 'Aktif - ' . $student->classroom->name : 'Belum Ada Kelas' }}
            </span>
        </div>

        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Avatar / Photo Section -->
                <div class="flex-shrink-0 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full bg-gray-200 border-4 border-white shadow-lg overflow-hidden flex items-center justify-center text-gray-400">
                        <i class="fa-solid fa-user text-5xl"></i>
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-900 text-center">{{ $student->name }}</h3>
                    <p class="text-school font-medium mt-1">{{ $student->nis }}</p>
                </div>

                <!-- Detail Information Section -->
                <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Informasi Akademik</h4>
                        <dl class="space-y-3 text-sm">
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">NISN</dt>
                                <dd class="font-medium text-gray-900">{{ $student->nisn }}</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Kelas Saat Ini</dt>
                                <dd class="font-medium text-gray-900">{{ $student->classroom?->name ?? 'Belum ditentukan' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Data Pribadi</h4>
                        <dl class="space-y-3 text-sm">
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Jenis Kelamin</dt>
                                <dd class="font-medium text-gray-900">{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Tempat, Tanggal Lahir</dt>
                                <dd class="font-medium text-gray-900">{{ $student->birth_place }}, {{ \Carbon\Carbon::parse($student->birth_date)->format('d F Y') }}</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Alamat</dt>
                                <dd class="font-medium text-gray-900 text-right">{{ $student->address ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Informasi Wali</h4>
                        <dl class="space-y-3 text-sm">
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Nama Wali</dt>
                                <dd class="font-medium text-gray-900">{{ $student->parent?->name ?? '-' }}</dd>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b border-gray-50 pb-2">
                                <dt class="text-gray-500">Email Wali</dt>
                                <dd class="font-medium text-gray-900">{{ $student->parent?->email ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
