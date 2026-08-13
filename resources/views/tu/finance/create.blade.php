<x-admin-layout>
    @section('header', 'Buat Tagihan Baru')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Buat Tagihan (Invoice)</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('tu.finance.store') }}" method="POST" x-data="{ billingType: 'per_student' }">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="billing_type">Tipe Penagihan</label>
                    <select name="billing_type" id="billing_type" x-model="billingType" class="w-full border-gray-300 rounded-lg" required>
                        <option value="per_student">Per Siswa</option>
                        <option value="per_class">Per Kelas</option>
                        <option value="all_classes">Semua Kelas / Seluruh Siswa</option>
                    </select>
                </div>

                <div class="mb-4" x-show="billingType === 'per_student'">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="student_id">Pilih Siswa</label>
                    <select name="student_id" id="student_id" class="w-full border-gray-300 rounded-lg" :required="billingType === 'per_student'">
                        <option value="">Pilih Siswa</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->nis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4" x-show="billingType === 'per_class'" style="display: none;">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="classroom_id">Pilih Kelas</label>
                    <select name="classroom_id" id="classroom_id" class="w-full border-gray-300 rounded-lg" :required="billingType === 'per_class'">
                        <option value="">Pilih Kelas</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Keterangan / Judul Tagihan</label>
                    <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: SPP Bulan Agustus" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">Jumlah Tagihan (Rp)</label>
                    <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-lg" placeholder="Contoh: 150000" min="0" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Jatuh Tempo</label>
                    <input type="date" name="due_date" id="due_date" class="w-full border-gray-300 rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_paid" value="1" class="form-checkbox h-5 w-5 text-school">
                        <span class="ml-2 text-gray-700">Tandai sudah lunas (Sudah Dibayar)</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button class="bg-school hover:bg-school-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Tagihan
                    </button>
                    <a href="{{ route('tu.finance.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
