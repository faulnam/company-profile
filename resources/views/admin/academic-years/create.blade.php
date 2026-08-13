<x-admin-layout>
    @section('header', 'Tambah Tahun Ajaran')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Tambah Tahun Ajaran</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.academic-years.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tahun Ajaran</label>
                    <input type="text" name="name" id="name" placeholder="Contoh: 2024/2025 Genap" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('name') }}" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-school focus:ring-school" {{ old('is_active') ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700 font-medium">Jadikan Tahun Ajaran Aktif (Tahun ajaran aktif lain akan otomatis non-aktif)</span>
                    </label>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.academic-years.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
