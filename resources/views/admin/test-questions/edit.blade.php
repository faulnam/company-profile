<x-admin-layout>
    @section('header', 'Edit Soal Ujian')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Soal</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.test-questions.update', $testQuestion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="question">Pertanyaan</label>
                    <textarea name="question" id="question" rows="4" class="w-full border-gray-300 rounded-lg focus:ring-school focus:border-school" required>{{ $testQuestion->question }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="option_a">Pilihan A</label>
                        <input type="text" name="option_a" id="option_a" class="w-full border-gray-300 rounded-lg" value="{{ $testQuestion->option_a }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="option_b">Pilihan B</label>
                        <input type="text" name="option_b" id="option_b" class="w-full border-gray-300 rounded-lg" value="{{ $testQuestion->option_b }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="option_c">Pilihan C</label>
                        <input type="text" name="option_c" id="option_c" class="w-full border-gray-300 rounded-lg" value="{{ $testQuestion->option_c }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="option_d">Pilihan D</label>
                        <input type="text" name="option_d" id="option_d" class="w-full border-gray-300 rounded-lg" value="{{ $testQuestion->option_d }}" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="correct_answer">Kunci Jawaban</label>
                    <select name="correct_answer" id="correct_answer" class="w-full md:w-1/3 border-gray-300 rounded-lg" required>
                        <option value="">Pilih Jawaban Benar</option>
                        <option value="A" {{ $testQuestion->correct_answer == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $testQuestion->correct_answer == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $testQuestion->correct_answer == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $testQuestion->correct_answer == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button class="bg-school hover:bg-school-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.test-questions.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
