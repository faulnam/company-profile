<x-admin-layout>
    @section('header', 'Tambah Kelas')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Tambah Kelas Baru</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('tu.classrooms.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school" placeholder="Misal: X IPA 1" required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <select name="major_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school" required>
                            <option value="">Pilih Jurusan...</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('major_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Wali Kelas</label>
                        <select name="teacher_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school" required>
                            <option value="">Pilih Wali Kelas...</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <hr class="my-6 border-gray-100">

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-800 mb-4">Pilih Mata Pelajaran (Wajib/Peminatan)</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($subjects as $subject)
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="w-4 h-4 text-school bg-gray-100 border-gray-300 rounded focus:ring-school">
                            <div class="ml-3 text-sm">
                                <span class="font-medium text-gray-800">{{ $subject->name }}</span>
                                <span class="block text-xs text-gray-500">{{ $subject->type }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('subjects') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('tu.classrooms.index') }}" class="px-5 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="bg-school hover:bg-school-dark text-white px-5 py-2 rounded-lg text-sm font-medium transition">Simpan Kelas</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
