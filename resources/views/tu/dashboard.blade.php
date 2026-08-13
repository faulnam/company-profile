<x-admin-layout>
    @section('header', 'Dashboard Tata Usaha')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ \App\Models\Student::count() }}</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Total Siswa Aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-green-50 border border-green-100 text-green-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">0</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Pendaftar PPDB Baru</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center text-xl mr-5">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight">Rp 0</h3>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Pemasukan SPP Bulan Ini</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kehadiran Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Siswa Terbaru</h2>
                <a href="{{ route('tu.students.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Kelola Siswa</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Belum ada data siswa.</p>
                </div>
            </div>
        </div>

        <!-- PPDB / Finance Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-sm font-bold text-gray-800">Transaksi SPP Terbaru</h2>
                <a href="{{ route('tu.finance.index') }}" class="text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md px-3 py-1.5 hover:bg-gray-50 transition">Rekap Keuangan</a>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500">Belum ada transaksi bulan ini.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
