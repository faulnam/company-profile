<aside class="space-y-6">
    <x-hero.tabs />
    <x-sidebar.search />
    
    <!-- Info Panel / Banner PPDB (Optional) -->
    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-6 text-center shadow-sm rounded-xl">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Pendaftaran PPDB</h3>
        <p class="text-sm text-gray-800 mb-4">Pendaftaran Peserta Didik Baru Telah Dibuka. Segera daftarkan diri Anda!</p>
        <a href="{{ route('ppdb.pendaftaran') }}" class="inline-block bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition">Daftar Sekarang</a>
    </div>

    <x-sidebar.calendar />
    <x-sidebar.categories />
    <x-sidebar.recent-posts />
</aside>
