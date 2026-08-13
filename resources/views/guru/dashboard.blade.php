<x-admin-layout>
    @section('header', 'Dashboard Wali Kelas')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">36</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Siswa di Kelas Anda</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-green-50 border border-green-100 text-green-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">95%</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Rata-rata Kehadiran</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-yellow-50 border border-yellow-100 text-yellow-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-star"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">82.5</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Rata-rata Nilai Kelas</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Absensi Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Absensi Hari Ini</h2>
                <a href="{{ route('guru.absensi.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Input Absen</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Anda belum menginput absensi hari ini.</p>
                </div>
            </div>
        </div>

        <!-- Nilai Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Tugas & Ujian Terbaru</h2>
                <a href="{{ route('guru.nilai.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Input Nilai</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Belum ada tugas atau ujian minggu ini.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
