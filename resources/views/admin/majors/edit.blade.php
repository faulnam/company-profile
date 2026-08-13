<x-admin-layout>
    @section('header', 'Edit Jurusan')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Jurusan</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.majors.update', $major->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Jurusan</label>
                        <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('name', $major->name) }}" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label for="acronym" class="block text-sm font-medium text-gray-700 mb-1">Singkatan / Akronim</label>
                        <input type="text" name="acronym" id="acronym" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('acronym', $major->acronym) }}" required>
                        @error('acronym') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="head_of_major" class="block text-sm font-medium text-gray-700 mb-1">Kepala Program (KAPROG)</label>
                    <select name="head_of_major" id="head_of_major" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50">
                        <option value="">Tidak Ada / Pilih Kaprog...</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->name }}" {{ old('head_of_major', $major->head_of_major) == $teacher->name ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    @error('head_of_major') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Jurusan</label>
                    <textarea name="description" id="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" required>{{ old('description', $major->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                    @if($major->image)
                        <img src="{{ $major->image }}" class="w-24 h-24 object-cover rounded border border-gray-200 mb-3">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded border border-gray-200 mb-3 flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                    
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar Baru</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.majors.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Update Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
