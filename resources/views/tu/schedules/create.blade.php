<x-admin-layout>
    @section('header', 'Tambah Jadwal Pelajaran')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Tambah Jadwal Pelajaran</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('tu.schedules.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="classroom_id">Kelas</label>
                        <select name="classroom_id" id="classroom_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="subject_id">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Mapel</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="teacher_id">Guru Pengajar</label>
                        <select name="teacher_id" id="teacher_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Guru</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="day">Hari</label>
                        <select name="day" id="day" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="start_time">Jam Mulai</label>
                        <input type="time" name="start_time" id="start_time" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="end_time">Jam Selesai</label>
                        <input type="time" name="end_time" id="end_time" class="w-full border-gray-300 rounded-lg" required>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button class="bg-school hover:bg-school-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan
                    </button>
                    <a href="{{ route('tu.schedules.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
