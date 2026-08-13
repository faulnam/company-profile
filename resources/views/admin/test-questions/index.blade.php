<x-admin-layout>
    @section('header', 'Bank Soal PPDB')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Soal Tes PPDB</h2>
            <a href="{{ route('admin.test-questions.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Soal
            </a>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4 w-12">No</th>
                        <th class="py-3 px-4 w-1/2">Pertanyaan</th>
                        <th class="py-3 px-4">Kunci Jawaban</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($questions as $index => $q)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4">{{ $questions->firstItem() + $index }}</td>
                        <td class="py-3 px-4">
                            <div class="font-medium text-gray-800 mb-1">{{ $q->question }}</div>
                            <ul class="text-xs text-gray-500 space-y-1">
                                <li class="{{ $q->correct_answer == 'A' ? 'text-green-600 font-bold' : '' }}">A. {{ $q->option_a }}</li>
                                <li class="{{ $q->correct_answer == 'B' ? 'text-green-600 font-bold' : '' }}">B. {{ $q->option_b }}</li>
                                <li class="{{ $q->correct_answer == 'C' ? 'text-green-600 font-bold' : '' }}">C. {{ $q->option_c }}</li>
                                <li class="{{ $q->correct_answer == 'D' ? 'text-green-600 font-bold' : '' }}">D. {{ $q->option_d }}</li>
                            </ul>
                        </td>
                        <td class="py-3 px-4 font-bold text-school">{{ $q->correct_answer }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.test-questions.edit', $q->id) }}" class="text-blue-500 hover:text-blue-700 p-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.test-questions.destroy', $q->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada soal tes yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($questions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $questions->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
