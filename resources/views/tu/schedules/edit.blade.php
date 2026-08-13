<x-admin-layout>
    @section('header', 'Edit Jadwal Pelajaran')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Jadwal Pelajaran</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('tu.schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="classroom_id">Kelas</label>
                        <select name="classroom_id" id="classroom_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}" {{ $schedule->classroom_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="subject_id">Mata Pelajaran</label>
                        <select name="subject_id" id="subject_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Mapel</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="teacher_id">Guru Pengajar</label>
                        <select name="teacher_id" id="teacher_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Guru</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="day">Hari</label>
                        <select name="day" id="day" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin" {{ $schedule->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $schedule->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $schedule->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $schedule->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $schedule->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ $schedule->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="start_time">Jam Mulai</label>
                        <input type="time" name="start_time" id="start_time" class="w-full border-gray-300 rounded-lg" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="end_time">Jam Selesai</label>
                        <input type="time" name="end_time" id="end_time" class="w-full border-gray-300 rounded-lg" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" required>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button class="bg-school hover:bg-school-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tu.schedules.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
