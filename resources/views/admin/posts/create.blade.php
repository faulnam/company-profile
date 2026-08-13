<x-admin-layout>
    @section('header', 'Tulis Berita')

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Main Content Area -->
            <div class="lg:w-2/3 space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 space-y-6">
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                            <input type="text" name="title" id="title" class="w-full text-lg rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('title') }}" required autofocus placeholder="Masukkan judul berita yang menarik">
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" id="excerpt" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" placeholder="Ringkasan singkat untuk ditampilkan di kartu berita">{{ old('excerpt') }}</textarea>
                            @error('excerpt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
                            <!-- Nanti bisa diganti WYSIWYG editor -->
                            <textarea name="content" id="content" rows="15" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sidebar Area -->
            <div class="lg:w-1/3 space-y-6">
                <!-- Publish Box -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 font-bold text-sm text-gray-800">
                        Publikasi
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50">
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan sebagai konsep)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish (Opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('published_at') }}">
                            <p class="text-[10px] text-gray-500 mt-1">Kosongkan jika ingin di-publish sekarang atau draft.</p>
                            @error('published_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="flex items-center space-x-2 cursor-pointer mt-4">
                                <input type="checkbox" name="is_highlight" value="1" class="rounded border-gray-300 text-school focus:ring-school" {{ old('is_highlight') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700 font-medium">Jadikan Highlight (Tampil di Hero Slider)</span>
                            </label>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex space-x-2">
                            <button type="submit" class="w-full py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition text-center">
                                Simpan Berita
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 font-bold text-sm text-gray-800">
                        Gambar Utama (Thumbnail)
                    </div>
                    <div class="p-4">
                        <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                        <p class="text-xs text-gray-500 mt-2">Format: JPG/PNG, Maksimal: 2MB. Rasio disarankan 16:9.</p>
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 font-bold text-sm text-gray-800">
                        Kategori
                    </div>
                    <div class="p-4 max-h-48 overflow-y-auto space-y-2">
                        @forelse($categories as $category)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded border-gray-300 text-school focus:ring-school" {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $category->name }}</span>
                        </label>
                        @empty
                        <p class="text-sm text-gray-500">Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-school hover:underline">Buat baru</a>.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
