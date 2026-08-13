<x-admin-layout>
    @section('header', 'Tambah Pengumuman')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Pengumuman</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded-lg focus:ring-school focus:border-school" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Isi Pengumuman</label>
                <textarea name="content" rows="6" class="w-full border-gray-300 rounded-lg focus:ring-school focus:border-school" required></textarea>
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" class="form-checkbox text-school border-gray-300 rounded" checked>
                    <span class="ml-2 text-gray-700">Tampilkan ke Publik / Wali Murid</span>
                </label>
            </div>
            
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.announcements.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-school hover:bg-school-dark text-white font-medium py-2 px-6 rounded-lg transition">Simpan Pengumuman</button>
            </div>
        </form>
    </div>
</x-admin-layout>
