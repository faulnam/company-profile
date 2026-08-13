<x-admin-layout>
    @section('header', 'Edit Tagihan')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Form Edit Tagihan (Invoice)</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('tu.finance.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="student_id">Pilih Siswa</label>
                    <select name="student_id" id="student_id" class="w-full border-gray-300 rounded-lg" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $invoice->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }} - {{ $student->nis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Keterangan / Judul Tagihan</label>
                    <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-lg" value="{{ $invoice->title }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">Jumlah Tagihan (Rp)</label>
                    <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-lg" value="{{ $invoice->amount }}" min="0" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Jatuh Tempo</label>
                    <input type="date" name="due_date" id="due_date" class="w-full border-gray-300 rounded-lg" value="{{ $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '' }}">
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_paid" value="1" class="form-checkbox h-5 w-5 text-school" {{ $invoice->is_paid ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Tandai sudah lunas (Sudah Dibayar)</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button class="bg-school hover:bg-school-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tu.finance.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
