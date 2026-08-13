<x-admin-layout>
    @section('header', 'Edit Data GTK')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit GTK</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('name', $teacher->name) }}" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP (Opsional)</label>
                        <input type="text" name="nip" id="nip" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" value="{{ old('nip', $teacher->nip) }}">
                        @error('nip') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Jabatan / Posisi</label>
                        <select name="position" id="position" class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50" required>
                            <option value="">Pilih Posisi...</option>
                            <option value="Guru" {{ old('position', $teacher->position) == 'Guru' ? 'selected' : '' }}>Guru</option>
                            <option value="Staff Tata Usaha" {{ old('position', $teacher->position) == 'Staff Tata Usaha' ? 'selected' : '' }}>Staff Tata Usaha</option>
                            <option value="Kepala Sekolah" {{ old('position', $teacher->position) == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                            <option value="Wakil Kepala Sekolah" {{ old('position', $teacher->position) == 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                        </select>
                        @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        @php
                            $teacherSubjects = $teacher->subject ? explode(', ', $teacher->subject) : [];
                            $oldSubjects = old('subjects', $teacherSubjects);
                        @endphp
                        <label for="subjects" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran (Bisa lebih dari satu jika Guru)</label>
                        <select name="subjects[]" id="subjects" multiple class="w-full rounded-md border-gray-300 shadow-sm focus:border-school focus:ring focus:ring-school focus:ring-opacity-50 min-h-[100px]">
                            @foreach($subjects as $subj)
                                <option value="{{ $subj->name }}" {{ (is_array($oldSubjects) && in_array($subj->name, $oldSubjects)) ? 'selected' : '' }}>{{ $subj->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Tahan tombol Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu.</p>
                        @error('subjects') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                    @if($teacher->photo)
                        <img src="{{ $teacher->photo }}" class="w-24 h-24 object-cover rounded border border-gray-200 mb-3">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded border border-gray-200 mb-3 flex items-center justify-center text-gray-400">No Photo</div>
                    @endif
                    
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto Baru</label>
                    <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-school rounded-md hover:bg-school-dark transition">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
