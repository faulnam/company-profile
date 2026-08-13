<x-admin-layout>
    @section('header', 'Informasi Tagihan SPP')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Tagihan Anak Anda</h2>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('wali.tagihan.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tagihan..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="status" class="w-full md:w-48 py-2 px-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
                    <option value="">Semua Status</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                </select>
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Anak</th>
                        <th class="py-3 px-4">Keterangan Tagihan</th>
                        <th class="py-3 px-4">Jatuh Tempo</th>
                        <th class="py-3 px-4">Jumlah (Rp)</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($invoices as $invoice)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $invoice->student?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $invoice->title }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}</td>
                        <td class="py-3 px-4 font-mono text-gray-700">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            @if($invoice->is_paid)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Belum Lunas</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if(!$invoice->is_paid)
                            <form action="{{ route('wali.tagihan.pay', $invoice->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membayar tagihan ini? (Simulasi)');">
                                @csrf
                                <button type="submit" class="bg-school hover:bg-school-dark text-white text-xs px-3 py-1.5 rounded transition">
                                    <i class="fa-solid fa-credit-card mr-1"></i> Bayar
                                </button>
                            </form>
                            @else
                            <button disabled class="bg-gray-100 text-gray-400 text-xs px-3 py-1.5 rounded cursor-not-allowed">
                                Lunas
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">Tidak ada tagihan yang tertunda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($invoices->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $invoices->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
