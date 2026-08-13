<x-admin-layout>
    @section('header', 'Administrasi Keuangan')

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-800">Daftar Tagihan SPP & Pembayaran</h2>
            <div class="flex gap-2">
                @if(auth()->user()->hasRole('tu'))
                <a href="{{ route('tu.finance.create') }}" class="bg-school hover:bg-school-dark text-white px-4 py-2 rounded text-sm font-medium transition flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Buat Tagihan
                </a>
                @endif
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center" onclick="alert('Mengekspor Laporan Keuangan ke Excel... (Simulasi)')">
                    <i class="fa-solid fa-file-excel mr-2"></i> Rekap Laporan
                </button>
            </div>
        </div>

        <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('tu.finance.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center w-full gap-2 md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-school focus:ring-1 focus:ring-school">
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

        <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-gray-100 bg-gray-50/30">
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Tagihan (Keseluruhan)</p>
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Sudah Dibayar (Lunas)</p>
                    <p class="text-lg font-bold text-green-600">Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <i class="fa-solid fa-check-double"></i>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Belum Dibayar (Tunggakan)</p>
                    <p class="text-lg font-bold text-red-600">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto p-6 pt-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-sm font-semibold border-b-2 border-gray-200">
                        <th class="py-3 px-4">Nama Siswa</th>
                        <th class="py-3 px-4">Keterangan</th>
                        <th class="py-3 px-4">Jumlah (Rp)</th>
                        <th class="py-3 px-4">Jatuh Tempo</th>
                        <th class="py-3 px-4">Status</th>
                        @if(auth()->user()->hasRole('tu'))
                        <th class="py-3 px-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($invoices as $invoice)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $invoice->student?->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $invoice->title }}</td>
                        <td class="py-3 px-4 font-mono text-gray-700">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 text-gray-500">{{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}</td>
                        <td class="py-3 px-4">
                            @if($invoice->is_paid)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Belum Lunas</span>
                            @endif
                        </td>
                        @if(auth()->user()->hasRole('tu'))
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                @if(!$invoice->is_paid)
                                <form action="{{ route('tu.finance.update', $invoice->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_paid" value="1">
                                    <input type="hidden" name="student_id" value="{{ $invoice->student_id }}">
                                    <input type="hidden" name="title" value="{{ $invoice->title }}">
                                    <input type="hidden" name="amount" value="{{ $invoice->amount }}">
                                    <button type="submit" class="text-green-500 hover:text-green-700 p-1" title="Tandai Lunas">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('tu.finance.destroy', $invoice->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">Data tagihan tidak ditemukan.</td>
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
