<x-admin-layout>
    @section('header', 'Dashboard Wali Murid / Siswa')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-green-50 border border-green-100 text-green-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-money-check-dollar"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Lunas</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Status SPP Bulan Ini</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">100%</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Tingkat Kehadiran Anak</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-red-50 border border-red-100 text-red-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Belum</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Rapor Semester Tersedia</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tagihan Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Riwayat Pembayaran</h2>
                <a href="{{ route('wali.tagihan.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Cek Tagihan</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Belum ada riwayat tagihan yang ditampilkan.</p>
                </div>
            </div>
        </div>

        <!-- Akademik Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Grafik Kehadiran Mingguan</h2>
                <a href="{{ route('wali.absensi.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Detail Kehadiran</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Data grafik sedang disiapkan.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
