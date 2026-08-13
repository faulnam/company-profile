<x-admin-layout>
    @section('header', 'Edit Kategori')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Kategori</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Warna Label (Hex)</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" name="color" id="color" class="h-10 w-10 rounded border border-gray-300 cursor-pointer" value="{{ old('color', $category->color) }}" required>
                        <span class="text-xs text-gray-500">Pilih warna untuk *badge* kategori di halaman publik</span>
                    </div>
                    @error('color')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
