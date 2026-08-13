<x-admin-layout>
    @section('header', 'Tambah Halaman')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Tambah Halaman Statis</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Halaman</label>
                    <input type="text" name="title" id="title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('title') }}" required>
                    <p class="text-xs text-gray-500 mt-1">Slug/URL akan digenerate otomatis berdasarkan judul.</p>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Header (Opsional)</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, Maksimal: 2MB.</p>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                    <textarea name="content" id="content" rows="10" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Dukung format teks biasa atau HTML ringan.</p>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Simpan Halaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
