<x-admin-layout>
    @section('header', 'Nilai & Rapor')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Nilai Akademik Anak Anda</h2>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Anak</th>
                        <th class="py-3 px-4">Mata Pelajaran</th>
                        <th class="py-3 px-4 text-center">Nilai Angka</th>
                        <th class="py-3 px-4">Keterangan / Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($grades as $grade)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $grade->student?->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $grade->subject?->name }}</td>
                        <td class="py-3 px-4 text-center font-bold {{ $grade->score < 75 ? 'text-red-500' : 'text-green-600' }}">
                            {{ $grade->score }}
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $grade->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada nilai yang dimasukkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($grades->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $grades->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
